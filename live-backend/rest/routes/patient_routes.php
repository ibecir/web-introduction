<?php

require_once __DIR__ . '/../services/PatientService.class.php';

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

Flight::set('patient_service', new PatientService());

/**
 * @OA\Get(
 *      path="/doctors",
 *      tags={"doctors"},
 *      summary="Get all doctors - dummy route for understanding the benefit of tags in the swagger",
 *      @OA\Response(
 *           response=200,
 *           description="Array of all doctors in the databases"
 *      )
 * )
 */
Flight::route('GET /doctors', function() {
    Flight::json([
        [
            'first_name' => 'Becir',
            'last_name' => 'Isakovic'
        ]
    ]);
});

Flight::group('/patients', function() {
    
    /**
     * @OA\Get(
     *      path="/patients/all",
     *      tags={"patients"},
     *      summary="Get all patients",
     *      @OA\Response(
     *           response=200,
     *           description="Array of all patients in the databases"
     *      )
     * )
     */
    Flight::route('GET /all', function() {
        $data = Flight::get('patient_service')->get_all_patients();
        Flight::json($data, 200);
    });

    /**
     * @OA\Get(
     *      path="/patients/patient",
     *      tags={"patients"},
     *      summary="Get patient by id",
     *      @OA\Response(
     *           response=200,
     *           description="Patient data, or false if patient does not exist"
     *      ),
     *      @OA\Parameter(@OA\Schema(type="number"), in="query", name="patient_id", example="1", description="Patient ID")
     * )
     */
    Flight::route('GET /patient', function() {
        $params = Flight::request()->query;

        $patient = Flight::get('patient_service')->get_patient_by_id($params['patient_id']);
        Flight::json($patient);
    });

    /**
     * @OA\Get(
     *      path="/patients/get/{patient_id}",
     *      tags={"patients"},
     *      summary="Get patient by id",
     *      @OA\Response(
     *           response=200,
     *           description="Patient data, or false if patient does not exist"
     *      ),
     *      @OA\Parameter(@OA\Schema(type="number"), in="path", name="patient_id", example="1", description="Patient ID")
     * )
     */
    Flight::route('GET /get/@patient_id', function($patient_id) {
        $patient = Flight::get('patient_service')->get_patient_by_id($patient_id);
        Flight::json($patient);
    });

    Flight::route('GET /', function() {
        try {
            $token = Flight::request()->getHeader("Authentication");
            if(!$token)
                Flight::halt(401, "Missing authentication header");

            JWT::decode($token, new Key(JWT_SECRET, 'HS256'));
        } catch (\Exception $e) {
            Flight::halt(401, $e->getMessage());
        }

        $payload = Flight::request()->query;

        $params = [
            'start' => (int)$payload['start'],
            'search' => $payload['search']['value'],
            'draw' => $payload['draw'],
            'limit' => (int)$payload['length'],
            'order_column' => $payload['order'][0]['name'],
            'order_direction' => $payload['order'][0]['dir'],
        ];

        $data = Flight::get('patient_service')->get_patients_paginated($params['start'], $params['limit'], $params['search'], $params['order_column'], $params['order_direction']);

        foreach($data['data'] as $id => $patient) {
            $data['data'][$id]['action'] = '<div class="btn-group" role="group" aria-label="Actions">' .
                                                '<button type="button" class="btn btn-warning" onclick="PatientService.open_edit_patient_modal('. $patient['id'] .')">Edit</button>' .
                                                '<button type="button" class="btn btn-danger" onclick="PatientService.delete_patient('. $patient['id'] .')">Delete</button>' .
                                            '</div>';
        }

        Flight::json([
            'draw' => $params['draw'],
            'data' => $data['data'],
            'recordsFiltered' => $data['count'],
            'recordsTotal' => $data['count'],
            'end' => $data['count']
        ], 200);
    });

    /**
     * @OA\Post(
     *      path="/patients/add",
     *      tags={"patients"},
     *      summary="Add patient data to the database",
     *      @OA\Response(
     *           response=200,
     *           description="Patient data, or exception if patient is not added properly"
     *      ),
     *      @OA\RequestBody(
     *          description="Patient data payload",
     *          @OA\JsonContent(
     *              required={"first_name","last_name","email"},
     *              @OA\Property(property="id", type="string", example="1", description="Patient ID"),
     *              @OA\Property(property="first_name", type="string", example="Some first name", description="Patient first name"),
     *              @OA\Property(property="last_name", type="string", example="Some last name", description="Patient last name"),
     *              @OA\Property(property="email", type="string", example="example@example.com", description="Patient email address"),
     *              @OA\Property(property="created_at", type="string", format="date", example="2024-04-29", description="Patient email address"),
     *              @OA\Property(property="password", type="string", example="some_secret_password", description="Patient password")
     *          )
     *      )
     * )
     */
    Flight::route('POST /add', function() {
        $payload = Flight::request()->data->getData();

        if($payload['first_name'] == NULL || $payload['first_name'] == '') {
            Flight::halt(500, "First name field is missing");
        }

        if($payload['id'] != NULL && $payload['id'] != ''){
            $patient = Flight::get('patient_service')->edit_patient($payload);
        } else {
            unset($payload['id']);
            $patient = Flight::get('patient_service')->add_patient($payload);
        }

        Flight::json(['message' => "You have successfully added the patient", 'data' => $patient]);
    });

    /**
     * @OA\Delete(
     *      path="/patients/delete/{patient_id}",
     *      tags={"patients"},
     *      summary="Delete patient by id",
     *      @OA\Response(
     *           response=200,
     *           description="Deleted patient data or 500 status code exception otherwise"
     *      ),
     *      @OA\Parameter(@OA\Schema(type="number"), in="path", name="patient_id", example="1", description="Patient ID")
     * )
     */
    Flight::route('DELETE /delete/@patient_id', function($patient_id) {
        if($patient_id == NULL || $patient_id == '') {
            Flight::halt(500, "You have to provide valid patient id!");
        }

        Flight::get('patient_service')->delete_patient_by_id($patient_id);
        Flight::json(['message' => 'You have successfully deleted the patient!'], 200);
    });

    /**
     * @OA\Get(
     *      path="/patients/{patient_id}",
     *      tags={"patients"},
     *      summary="Get patient by id",
     *      @OA\Response(
     *           response=200,
     *           description="Patient data, or false if patient does not exist"
     *      ),
     *      @OA\Parameter(@OA\Schema(type="number"), in="path", name="patient_id", example="1", description="Patient ID")
     * )
     */
    Flight::route('GET /@patient_id', function($patient_id) {
        $patient = Flight::get('patient_service')->get_patient_by_id($patient_id);

        Flight::json($patient, 200);
    });
});
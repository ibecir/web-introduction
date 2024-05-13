<?php

require_once __DIR__ . '/../services/PatientService.class.php';

Flight::group('/patients', function() {

    /**
     * @OA\Get(
     *      path="/patients",
     *      tags={"patients"},
     *      summary="Get all patients",
     *      security={
     *          {"ApiKey": {}}
     *      },
     *      @OA\Response(
     *           response=200,
     *           description="Get all patients"
     *      ),
     *      @OA\Parameter(@OA\Schema(type="number"), in="query", name="start", example="0", description="Start index"),
     *      @OA\Parameter(@OA\Schema(type="number"), in="query", name="length", example="0", description="End index"),
     *      @OA\Parameter(@OA\Schema(type="number"), in="query", name="draw", example="1", description="Draw")
     * )
     */
    Flight::route('GET /', function () {
        $body = Flight::request()->query;
        $params = [
            "start" => (int)$body['start'],
            "search" => "",
            "draw" => $body['draw'],
            "limit" => (int)$body['length'],
            "order_column" => $body['order'][0]['name'],
            "order_direction" => $body['order'][0]['dir'],
        ];

        $patient_service = new PatientService();

        $count = $patient_service->count_patients($params['search']);
        $patients = $patient_service->get_patients(
            $params['start'],
            $params['limit'],
            $params['search'],
            $params['order_column'],
            $params['order_direction']
        );

        foreach ($patients as $id => $patient) {
            $patients[$id]['action'] = '<div class="btn-group" role="group" aria-label="Actions">' .
                                            '<button type="button" class="btn btn-warning" onclick="PatientService.open_edit_patient_modal('. $patient['id'] .')">Edit</button>' .
                                            '<button type="button" class="btn btn-danger" onclick="PatientService.delete_patient('. $patient['id'] .')">Delete</button>' .
                                    '</div>';
        }
        Flight::json([
            'draw' => $params['draw'],
            'data' => $patients,
            'recordsFiltered' => $count['count'],
            'recordsTotal' => $count['count'],
            'end' => $count['count']
        ], 200);
    });

    /**
     * @OA\Get(
     *      path="/patients/all",
     *      tags={"patients"},
     *      summary="Get all patients",
     *      @OA\Response(
     *           response=200,
     *           description="Get all patients"
     *      )
     * )
     */
    Flight::route('GET /all', function () {
        $patient_service = new PatientService();
        $patient = $patient_service->get_all_patients();
        Flight::json($patient, 200);
    });

    /**
     * @OA\Get(
     *      path="/patients/patient",
     *      tags={"patients"},
     *      summary="Get patient by ID",
     *      @OA\Response(
     *           response=200,
     *           description="Get patient by ID"
     *      ),
     *      @OA\Parameter(@OA\Schema(type="number"), in="query", name="patient_id", example="1", description="Patient ID")
     * )
     */
    Flight::route('GET /patient', function () {
        $body = Flight::request()->query;

        $patient_service = new PatientService();
        $patient = $patient_service->get_patient_by_id($body['patient_id']);
        Flight::json($patient, 200);
    });

    /**
     * @OA\Post(
     *      path="/patients/add",
     *      tags={"patients"},
     *      summary="Add patient",
     *      @OA\Response(
     *           response=200,
     *           description="Logged user"
     *      ),
     *      @OA\RequestBody(
     *          description="Food ID",
     *          @OA\JsonContent(
     *             required={"first_name", "last_name", "email"},
     *             @OA\Property(property="first_name", required=true, type="string", example="Becir"),
     *             @OA\Property(property="last_name", required=true, type="string", example="Isakovic"),
     *             @OA\Property(property="email", required=true, type="string", example="becir.isakovic@ibu.edu.ba"),
     *             @OA\Property(property="password", required=true, type="string", example="strong")
     *           )
     *      ),
     * )
     */
    Flight::route('POST /add', function () {
        $payload = Flight::request()->data->getData();
        if($payload['first_name'] == NULL || $payload['last_name'] == NULL || $payload['email'] == NULL) {
            Flight::halt(500, "Required parameters are missing!");
        }
        unset($payload['id']);
        $patient_service = new PatientService();
        $patient = $patient_service->add_patient($payload);
        Flight::json(['data' => $patient, 'message' => "You have successfully added the patient"]);
    });

    /**
     * @OA\Delete(
     *      path="/delete/{patient_id}",
     *      tags={"patients"},
     *      summary="Delete patient by id",
     *      @OA\Response(
     *           response=200,
     *           description="Status message"
     *      ),
     *      @OA\Parameter(@OA\Schema(type="number"), in="path", name="patient_id", example="1", description="Patient id")
     * )
     */
    Flight::route('DELETE /delete/@patient_id', function ($patient_id) {
        if($patient_id == NULL || $patient_id == '') {
            Flight::halt(500, "Required parameters are missing!");
        }

        $patient_service = new PatientService();
        $patient_service->delete_patient_by_id($patient_id);
        
        Flight::json(['data' => NULL, 'message' => "You have successfully deleted the patient"]);
    });
});
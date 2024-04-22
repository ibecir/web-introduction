<?php

require_once __DIR__ . '/../services/PatientService.class.php';

Flight::set('patient_service', new PatientService());

Flight::group('/patients', function() {
    Flight::route('GET /', function() {
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

    Flight::route('DELETE /delete/@patient_id', function($patient_id) {
        if($patient_id == NULL || $patient_id == '') {
            Flight::halt(500, "You have to provide valid patient id!");
        }

        Flight::get('patient_service')->delete_patient_by_id($patient_id);
        Flight::json(['message' => 'You have successfully deleted the patient!'], 200);
    });

    Flight::route('GET /@patient_id', function($patient_id) {
        $patient = Flight::get('patient_service')->get_patient_by_id($patient_id);

        Flight::json($patient, 200);
    });
});
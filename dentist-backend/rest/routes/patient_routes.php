<?php

require_once __DIR__ . '/../services/PatientService.class.php';

// Then define a route and assign a function to handle the request.
Flight::route('/', function () {
    echo 'hello world!';
});

Flight::group('/patients', function() {
    Flight::route('GET /', function () {
        $body = Flight::request()->query;
        $params = [
            "start" => (int)$body['start'],
            "search" => $body['search']['value'],
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

    Flight::route('DELETE /delete/@patient_id', function ($patient_id) {
        if($patient_id == NULL || $patient_id == '') {
            Flight::halt(500, "Required parameters are missing!");
        }

        $patient_service = new PatientService();
        $patient_service->delete_patient_by_id($patient_id);
        
        Flight::json(['data' => NULL, 'message' => "You have successfully deleted the patient"]);
    });
});
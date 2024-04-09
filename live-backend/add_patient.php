<?php
require_once __DIR__ . '/rest/services/PatientService.class.php';

$payload = $_REQUEST;

if($payload['first_name'] == NULL || $payload['first_name'] == '') {
    header('HTTP/1.1 500 Bad Request');
    die(json_encode(['error' => "First name field is missing"]));
}

$patient_service = new PatientService();

if($payload['id'] != NULL && $payload['id'] != ''){
    $patient = $patient_service->edit_patient($payload);
} else {
    unset($payload['id']);
    $patient = $patient_service->add_patient($payload);
}

echo json_encode(['message' => "You have successfully added the patient", 'data' => $patient]);
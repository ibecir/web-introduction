<?php
//https://github.com/DzelilaMehanovic/web-2023-spring/blob/main/rest/dao/StudentsDao.class.php
require_once __DIR__ . '/rest/services/PatientService.class.php';

$payload = $_REQUEST;

if($payload['first_name'] == NULL || $payload['last_name'] == NULL || $payload['email'] == NULL) {
    header('HTTP/1.1 500 Bad Request');
    die(json_encode(['error' => 'Required fields are missing. Please check the documentation for more info.']));
}

$patient_service = new PatientService();
$patient = $patient_service->add_patient($payload);
echo json_encode($patient);

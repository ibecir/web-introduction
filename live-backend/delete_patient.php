<?php

require_once __DIR__ . '/rest/services/PatientService.class.php';

$patient_id = $_REQUEST['id'];
if($patient_id == NULL || $patient_id == '') {
    header('HTTP/1.1 500 Bad Request');
    die(json_encode(['error' => "You have to provide valid patient id!"]));
}

$patient_service = new PatientService();
$patient_service->delete_patient_by_id($patient_id);
echo json_encode(['message' => 'You have successfully deleted the patient!']);


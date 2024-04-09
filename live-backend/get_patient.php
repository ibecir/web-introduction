<?php
require_once __DIR__ . '/rest/services/PatientService.class.php';

$patient_id = $_REQUEST['id'];

$patient_service = new PatientService();
$patient = $patient_service->get_patient_by_id($patient_id);

header('Content-Type: application/json');
echo json_encode($patient);
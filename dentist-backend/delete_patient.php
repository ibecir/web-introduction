<?php
//https://github.com/DzelilaMehanovic/web-2023-spring/blob/main/rest/dao/StudentsDao.class.php
require_once __DIR__ . '/rest/services/PatientService.class.php';

$patient_id = $_REQUEST['id'];

$patient_service = new PatientService();

$patient_service->delete_patient_by_id($patient_id);

header('Content-Type: application/json');
echo json_encode(['message' => 'You have successfully deleted the patient']);

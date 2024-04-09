<?php
//https://github.com/DzelilaMehanovic/web-2023-spring/blob/main/rest/dao/StudentsDao.class.php
require_once __DIR__ . '/rest/services/PatientService.class.php';

$payload = $_REQUEST;

$params = [
      "start" => (int)$payload['start'],
      "search" => $payload['search']['value'],
      "draw" => $payload['draw'],
      "limit" => (int)$payload['length'],
      "order_column" => $payload['order'][0]['name'],
      "order_direction" => $payload['order'][0]['dir'],
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

header('Content-Type: application/json');
echo json_encode([
    'draw' => $params['draw'],
    'data' => $patients,
    'recordsFiltered' => $count['count'],
    'recordsTotal' => $count['count'],
    'end' => $count['count']
]);

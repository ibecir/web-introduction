<?php
require_once __DIR__ . '/rest/services/PatientService.class.php';

$payload = $_REQUEST;

$params = [
    'start' => (int)$payload['start'],
    'search' => $payload['search']['value'],
    'draw' => $payload['draw'],
    'limit' => (int)$payload['length'],
    'order_column' => $payload['order'][0]['name'],
    'order_direction' => $payload['order'][0]['dir'],
];

$patient_service = new PatientService();

$data = $patient_service->get_patients_paginated($params['start'], $params['limit'], $params['search'], $params['order_column'], $params['order_direction']);

foreach($data['data'] as $id => $patient) {
    $data['data'][$id]['action'] = '<div class="btn-group" role="group" aria-label="Actions">' .
                                        '<button type="button" class="btn btn-warning" onclick="PatientService.open_edit_patient_modal('. $patient['id'] .')">Edit</button>' .
                                        '<button type="button" class="btn btn-danger" onclick="PatientService.delete_patient('. $patient['id'] .')">Delete</button>' .
                                    '</div>';
}

// Response
echo json_encode([
    'draw' => $params['draw'],
    'data' => $data['data'],
    'recordsFiltered' => $data['count'],
    'recordsTotal' => $data['count'],
    'end' => $data['count']
]);
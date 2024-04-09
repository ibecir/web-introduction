<?php

require_once __DIR__ . '/../dao/PatientDao.class.php';

class PatientService {
    private $patient_dao;
    public function __construct() {
        $this->patient_dao = new PatientDao();
    }
    public function add_patient($patient){
        return $this->patient_dao->add_patient($patient);
    }
    public function get_patients_paginated($offset, $limit, $search, $order_column, $order_direction){
        $count = $this->patient_dao->count_patients_paginated($search)['count'];
        $rows = $this->patient_dao->get_patients_paginated($offset, $limit, $search, $order_column, $order_direction);

        return [
            'count' => $count,
            'data' => $rows
        ];
    }
    public function delete_patient_by_id($patient_id) {
        $this->patient_dao->delete_patient_by_id($patient_id);
    }

    public function get_patient_by_id($patient_id) {
        return $this->patient_dao->get_patient_by_id($patient_id);
    }

    public function edit_patient($patient) {
        $id = $patient['id'];
        unset($patient['id']);

        $this->patient_dao->edit_patient($id, $patient);
    }
}
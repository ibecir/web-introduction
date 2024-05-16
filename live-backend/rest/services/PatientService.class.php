<?php

require_once __DIR__ . '/../dao/PatientDao.class.php';

class PatientService {
    private $patient_dao;
    public function __construct() {
        $this->patient_dao = new PatientDao();
    }
    public function add_patient($patient){
        $patient['password'] = password_hash($patient['password'], PASSWORD_BCRYPT);
        return $this->patient_dao->add_patient($patient);
    }
    public function get_patients_paginated($offset, $limit, $search, $order_column, $order_direction){
        $count = $this->patient_dao->count_patients_paginated($search)['count'];
        $rows = $this->patient_dao->get_patients_paginated($offset, $limit, $search, $order_column, $order_direction);

        foreach($rows as $id => $patient) {
            $rows[$id]['action'] = '<div class="btn-group" role="group" aria-label="Actions">' .
                                                '<button type="button" class="btn btn-warning" onclick="PatientService.open_edit_patient_modal('. $patient['id'] .')">Edit</button>' .
                                                '<button type="button" class="btn btn-danger" onclick="PatientService.delete_patient('. $patient['id'] .')">Delete</button>' .
                                            '</div>';
        }

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

    public function get_all_patients(){
        return $this->patient_dao->get_all_patients();
    }
}
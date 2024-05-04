<?php

require_once __DIR__ . '/../dao/PatientDao.class.php';

class PatientService {

      private $patient_dao;

      public function __construct() {
            $this->patient_dao = new PatientDao();
      }

      public function get_all_patients() {
            return $this->patient_dao->get();
      }

      public function add_patient($patient) {
            $patient['password'] = password_hash($patient['password'], PASSWORD_BCRYPT);
            return $this->patient_dao->add($patient);
      }

      public function get_patients($offset, $limit, $search, $order_column, $order_direction) {
            return $this->patient_dao->get_patients($offset, $limit, $search, $order_column, $order_direction);
      }
      public function count_patients($search) {
            return $this->patient_dao->count_patients($search);
      }
      public function get_patient_by_id($patient_id) {
            return $this->patient_dao->get_patient_by_id($patient_id);
      }

      public function delete_patient_by_id($patient_id) {
            return $this->patient_dao->delete_patient_by_id($patient_id);
      }
}

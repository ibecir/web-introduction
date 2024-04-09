<?php

require_once __DIR__ . '/BaseDao.class.php';

class PatientDao extends BaseDao
{

  public function __construct() {
    parent::__construct("patients");
  }

  public function add($patient) {
    return $this->insert('patients', $patient);
  }
  public function get_patients($offset, $limit, $search, $order_column, $order_direction) {
    $query = "SELECT * 
              FROM patients
              WHERE LOWER(first_name) LIKE CONCAT('%', :search, '%') OR LOWER(last_name) LIKE CONCAT('%', :search, '%')
              ORDER BY {$order_column} {$order_direction}
              LIMIT {$offset}, {$limit}";
    return $this->query($query, ['search' => strtolower($search)]);
  }
  public function count_patients($search) {
    $query = "SELECT COUNT(*) AS count 
              FROM patients
              WHERE LOWER(first_name) LIKE CONCAT('%', :search, '%') OR LOWER(last_name) LIKE CONCAT('%', :search, '%')";
    return $this->query_unique($query, ['search' => strtolower($search)]);
  }
  public function get() {
    return $this->get_all(0, 100000);
  }
  public function get_patient_by_id($patient_id){
    return $this->query_unique("SELECT * FROM patients WHERE id = :id", ["id" => $patient_id]);
  }

  public function delete_patient_by_id($patient_id) {
    $this->execute("DELETE FROM patients WHERE id = :id", ["id" => $patient_id]);
  }
}

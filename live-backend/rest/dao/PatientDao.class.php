<?php

require_once __DIR__ . '/BaseDao.class.php';

class PatientDao extends BaseDao {
    public function __construct() {
        parent::__construct('patients');
    }
    public function add_patient($patient){
        /* 
        $query = "INSERT INTO patients (first_name, last_name, created_at, email)
                  VALUES(:first_name, :last_name, :created_at, :email)";
        $statement = $this->connection->prepare($query);
        $statement->execute($patient);
        $patient['id'] = $this->connection->lastInsertId();
        return $patient;
        */
        return $this->insert('patients', $patient);
    }

    public function count_patients_paginated($search) {
        $query = "SELECT COUNT(*) AS count
                  FROM patients
                  WHERE LOWER(first_name) LIKE CONCAT('%', :search, '%') OR 
                        LOWER(last_name) LIKE CONCAT('%', :search, '%') OR
                        LOWER(email) LIKE CONCAT('%', :search, '%');";
        return $this->query_unique($query, [
            'search' => $search
        ]);
    }

    public function get_patients_paginated($offset, $limit, $search, $order_column, $order_direction) {
        $query = "SELECT *
                  FROM patients
                  WHERE LOWER(first_name) LIKE CONCAT('%', :search, '%') OR 
                        LOWER(last_name) LIKE CONCAT('%', :search, '%') OR
                        LOWER(email) LIKE CONCAT('%', :search, '%')
                  ORDER BY {$order_column} {$order_direction}
                  LIMIT {$offset}, {$limit}";
        return $this->query($query, [
            'search' => $search
        ]);
    }

    public function delete_patient_by_id($id) {
        $query = "DELETE FROM patients WHERE id = :id";
        $this->execute($query, [
            'id' => $id
        ]);
    }

    public function get_patient_by_id($patient_id){
        return $this->query_unique(
            "SELECT *, DATE(created_at) as created_at FROM patients WHERE id = :id", 
            [
                'id' => $patient_id
            ]
        );
    }

    public function edit_patient($id, $patient) {
        $query = "UPDATE patients SET first_name = :first_name, last_name = :last_name, created_at = :created_at, email = :email
                  WHERE id = :id";
        $this->execute($query, [
            'first_name' => $patient['first_name'],
            'last_name' => $patient['last_name'],
            'created_at' => $patient['created_at'],
            'email' => $patient['email'],
            'id' => $id
        ]);
    }

    public function get_all_patients(){
        $query = "SELECT *
                  FROM patients;";
        return $this->query($query, []);
    }
}
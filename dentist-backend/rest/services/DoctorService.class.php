<?php

require_once __DIR__ . '/../dao/DoctorDao.class.php';

class DoctorService {
    private $doctor_dao;
    public function __construct() {
        $this->doctor_dao = new DoctorDao();
    }
}
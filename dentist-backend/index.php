<?php

require 'vendor/autoload.php';
require 'rest/routes/middleware_routes.php';
require 'rest/routes/patient_routes.php';
require 'rest/routes/doctor_routes.php';
require 'rest/routes/auth_routes.php';

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

Flight::start();
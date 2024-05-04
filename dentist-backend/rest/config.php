<?php
// Report all errors accept E_NOTICE
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL ^ (E_NOTICE | E_DEPRECATED));

// Database access credentials
define('DB_NAME', 'web-dentist');
define('DB_PORT', 3306);
define('DB_USER', 'root');
define('DB_PASS', '12345678');
define('DB_HOST', '127.0.0.1');

// JWT Secret
define('JWT_SECRET', 'hgY=&*54#T+kTe,8zT=7L-3z4tV/&9');

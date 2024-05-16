<?php
// Report all errors accept E_NOTICE
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL ^ (E_NOTICE | E_DEPRECATED));

class Config {
    public static function DB_NAME() {
        return Config::get_env("DB_NAME", "web-dentist");
    }
    public static function DB_PORT() {
        return Config::get_env("DB_PORT", 3306);
    }
    public static function DB_USER() {
        return Config::get_env("DB_USER", "root");
    }
    public static function DB_PASS() {
        return Config::get_env("DB_PASS", "12345678");
    }
    public static function DB_HOST() {
        return Config::get_env("DB_HOST", "127.0.0.1");
    }

    public static function JWT_SECRET() {
        return Config::get_env("JWT_SECRET", "hgY=&*54#T+kTe,8zT=7L-3z4tV/&9");
    }

    public static function get_env($name, $default) {
        return isset($_ENV[$name]) && trim($_ENV[$name]) != "" ? $_ENV[$name] : $default;
    }
}
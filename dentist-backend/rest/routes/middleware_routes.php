<?php

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

Flight::route('/*', function() {
    // Token is not needed for login or register page
    if (strpos(Flight::request()->url, '/auth/login') === 0) {
        return TRUE;
    } else {
        try {
            $token = Flight::request()->getHeader("Authentication");
            if(!$token)
                Flight::halt(401, "Unauthorized access. This will be reported to administrator!");

            $decoded_token = JWT::decode($token, new Key(JWT_SECRET, 'HS256'));
            Flight::set('user', $decoded_token->user);
            Flight::set('jwt_token', $token);
            return TRUE;
        } catch (\Exception $e) {
            Flight::halt(401, $e->getMessage());
        }
    }
});

Flight::map('error', function($e) {
    // TODO log all errors to file or log them to your database
    file_put_contents('logs.txt', $e.PHP_EOL , FILE_APPEND | LOCK_EX);

    Flight::halt($e->getCode(), $e->getMessage());
    Flight::stop($e->getCode());
});

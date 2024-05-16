<?php

require_once __DIR__ . '/../services/AuthService.class.php';
require_once __DIR__ . '/../config.php';

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

Flight::set('auth_service', new AuthService());

Flight::group('/auth', function() {
    
    /**
     * @OA\Post(
     *      path="/auth/login",
     *      tags={"auth"},
     *      summary="Login to system",
     *      @OA\Response(
     *           response=200,
     *           description="User data and JWT token"
     *      ),
     *      @OA\RequestBody(
     *          description="User credentials",
     *          @OA\JsonContent(
     *             required={"email", "password"},
     *             @OA\Property(property="email", required=true, type="string", example="becir.isakovic@ibu.edu.ba"),
     *             @OA\Property(property="password", required=true, type="string", example="pass")
     *           )
     *      ),
     * )
     */
    Flight::route('POST /login', function() {
        $payload = Flight::request()->data->getData();
        $patient = Flight::get('auth_service')->get_user_by_email($payload['email']);

        if(!$patient || !password_verify($payload['password'], $patient['password']))
            Flight::halt(500, "Invalid username or password");

        unset($patient['password']); // We should not encode password in token
        $payload = [
            'user' => $patient,
            'iat' => time(), // issued at
            'exp' => time() + 100000 // valid for 1 minute
        ];

        $token = JWT::encode(
            $payload, 
            Config::JWT_SECRET(), 
            /**
             * IMPORTANT:
             * You must specify supported algorithms for your application. See
             * https://tools.ietf.org/html/draft-ietf-jose-json-web-algorithms-40
             * for a list of spec-compliant algorithms.
             */
            'HS256'
        );

        Flight::json([
            'user' => array_merge($patient, ['token' => $token]),
            'token' => $token
        ]);
    });

    /**
     * @OA\Post(
     *      path="/auth/logout",
     *      tags={"auth"},
     *      summary="Logout from system",
     *      security={
     *          {"ApiKey": {}}
     *      },
     *      @OA\Response(
     *           response=200,
     *           description="Success response or exception"
     *      ),
     * )
     */
    Flight::route('POST /logout', function() {
        try {
            $token = Flight::request()->getHeader('Authentication');
            if($token){
                $decoded_token = JWT::decode($token, new Key(Config::JWT_SECRET(), 'HS256'));
                Flight::json([
                    'jwt_decoded' => $decoded_token,
                    'user' => $decoded_token->user
                ]);
            }
        } catch (\Exception $e){
            Flight::halt(500, $e->getMessage());
        }            
    });
});
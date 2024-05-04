<?php

require_once __DIR__ . '/../services/DoctorService.class.php';

Flight::set('doctor_service', new DoctorService());

Flight::group('/doctors', function() {
    
    /**
     * @OA\Get(
     *      path="/doctors",
     *      tags={"doctors"},
     *      summary="Get all doctors",
     *      @OA\Response(
     *           response=200,
     *           description="Array of all doctors in the databases"
     *      )
     * )
     */
    Flight::route('GET /', function() {
        Flight::json([
            [
                'first_name' => 'Becir',
                'last_name' => 'Isakovic'
            ],
            [
                'first_name' => 'Dzelila',
                'last_name' => 'Mehanovic'
            ]
        ]);
    });
});
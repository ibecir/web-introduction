<?php

require_once __DIR__ . '/../services/DoctorService.class.php';
require_once __DIR__ . '/../services/PatientService.class.php';

Flight::set('doctor_service', new DoctorService());
Flight::set('patient_service', new PatientService());

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

    /**
     * @OA\Get(
     *      path="/doctors/details",
     *      tags={"doctors"},
     *      summary="Get doctor details",
     *      security={
     *          {"ApiKey": {}}   
     *      },
     *      @OA\Response(
     *           response=200,
     *           description="Doctor details"
     *      )
     * )
     */
    Flight::route('GET /details', function() {
        Flight::json(Flight::get('patient_service')->get_patient_by_id(Flight::get('user')->id));
    });
});
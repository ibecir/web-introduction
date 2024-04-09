<?php

/**
 * @OA\Post(
 *      path="/sample/customers",
 *      tags={"sample"},
 *      summary="Add sample customer",
 *      @OA\Response(
 *           response=200,
 *           description="Appropriate message"
 *      ),
 *      @OA\RequestBody(
 *          description="Request data",
 *          @OA\JsonContent(
 *             required={"name", "created_at"},
 *             @OA\Property(property="name", required=true, type="string", example="Becir Isakovic"),
 *             @OA\Property(property="created_at", required=true, type="string", "2024-04-01")
 *           )
 *      ),
 * )
 */
Flight::route('POST /sample/customers', function () {
  $body = json_decode(Flight::request()->getBody(), TRUE);
  Flight::json(["message"=> "You have successfully addedd a customer", "data" => $body]);
});

/**
 * @OA\Get(
 *      path="/sample/customers",
 *      tags={"sample"},
 *      summary="Get customers",
 *      @OA\Response(
 *           response=200,
 *           description="Customers list"
 *      )
 * )
 */
Flight::route('GET /sample/customers', function () {
  $params = [
      "st" => (int)Flight::request()->query['start'],
      "s" => Flight::request()->query['search']['value'],
      "e" => (int)Flight::request()->query['draw'],
      "o" => Flight::request()->query['start'],
      "l" => (int)Flight::request()->query['length'],
      "or" => Flight::request()->query['order'],
  ];

  $customers = array(
      array('customer' => 'CJ87JKL9', 'created_at' => '2023-07-15'),
      array('customer' => '2DGH54AL', 'created_at' => '2023-05-20'),
      array('customer' => '9LZ68QWX', 'created_at' => '2023-10-03'),
      array('customer' => 'K1PQ7VZ3', 'created_at' => '2023-01-25'),
      array('customer' => 'T90J6E2F', 'created_at' => '2023-11-18'),
      array('customer' => 'R2W71H6X', 'created_at' => '2023-02-09'),
      array('customer' => '8K4P3NDM', 'created_at' => '2023-09-27'),
      array('customer' => 'QNG98B27', 'created_at' => '2023-04-05'),
      array('customer' => '7XFL6WY9', 'created_at' => '2023-08-13'),
      array('customer' => 'MZD3K8N1', 'created_at' => '2023-03-30'),
      array('customer' => 'P5BC7AWY', 'created_at' => '2023-12-22'),
      array('customer' => 'B28J1W5Z', 'created_at' => '2023-06-10'),
      array('customer' => 'HW3YQK7D', 'created_at' => '2023-01-03'),
      array('customer' => 'Y8VCN9M1', 'created_at' => '2023-11-28'),
      array('customer' => '5DLJK9BQ', 'created_at' => '2023-05-14'),
      array('customer' => '9W4G1ZPC', 'created_at' => '2023-10-08'),
      array('customer' => 'U0D78ZPL', 'created_at' => '2023-07-02'),
      array('customer' => 'J29WU5YH', 'created_at' => '2023-02-15'),
      array('customer' => '3R6L8CJG', 'created_at' => '2023-09-17'),
      array('customer' => 'N6KQDWL4', 'created_at' => '2023-04-25'),
      array('customer' => '7QG54XE8', 'created_at' => '2023-08-08'),
      array('customer' => 'C89YVZB6', 'created_at' => '2023-03-03'),
      array('customer' => 'W45HJVYN', 'created_at' => '2023-12-26'),
      array('customer' => 'K6V3G4A8', 'created_at' => '2023-06-18'),
      array('customer' => 'D1ZQF5TL', 'created_at' => '2023-01-11')
  );
  $end = $params['st'] + $params['l'];
  $temp = [];

  if($params['st'] + $params['l'] > count($customers)){
    $end = count($customers) - 1;
  }

  for($i = $params['st']; $i <= $end; $i++){
    $temp[] = $customers[$i];
  }

  Flight::json(
      [
          'draw' => $params['e'],
          'data' => $temp,
          'recordsFiltered' => count($customers),
          'recordsTotal' => count($customers),
          'end' => $end
      ]
  );
});
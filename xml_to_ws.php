<?php

  $rawData = file_get_contents("php://input");

  // Convertir el JSON a un array asociativo
  $data = json_decode($rawData, true);

  if (isset($data["data"])) {
    $xmlString = $data["data"]; // Aquí está el XML en formato string

    $curl = curl_init();

    $username = "int_test_ocs";
    $password = 'ocs_qad.2025$_';

    $authHeader = "Authorization: Basic " . base64_encode("$username:$password");

    curl_setopt_array($curl, array(
      CURLOPT_URL => 'http://201.236.140.195:8030/pilo/rest/piloService/ocsqad',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS =>'xmldata='.$xmlString,
      CURLOPT_HTTPHEADER => array(
        'Content-Type: application/x-www-form-urlencoded',
        $authHeader
      ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    echo $response;


  } 
  else {
    header("Content-Type: application/json");
    echo json_encode(["error" => "No se recibió XML dentro del JSON"]);
  }

?>
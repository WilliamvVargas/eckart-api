<?php

  $rawData = file_get_contents("php://input");

  // Convertir JSON a un array asociativo
  $data = json_decode($rawData, true);

  if ($data === null) {
      http_response_code(400);
      echo json_encode(["error" => "Invalid JSON"]);
      exit;
  }

  // Mostrar los datos recibidos
  header("Content-Type: application/json");
  echo json_encode(["received" => $data]);

?>
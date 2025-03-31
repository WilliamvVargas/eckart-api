<?php



  // Definir encabezados para permitir solicitudes desde cualquier origen (CORS)
  header("Access-Control-Allow-Origin: *");
  header("Content-Type: application/json");

  // Verificar si la solicitud es POST
  if ($_SERVER["REQUEST_METHOD"] !== "POST") {
      http_response_code(405); // Método no permitido
      echo json_encode(["error" => "Método no permitido. Usa POST."]);
      exit;
  }

  // Obtener el contenido RAW del cuerpo de la solicitud (XML)
  $xmlData = file_get_contents("php://input");

  // Validar si el contenido no está vacío
  if (!$xmlData) {
      http_response_code(400); // Solicitud incorrecta
      echo json_encode(["error" => "No se recibió ningún XML."]);
      exit;
  }

  // Intentar cargar el XML
  libxml_use_internal_errors(true); // Evitar que errores XML detengan el script
  $xmlObject = simplexml_load_string($xmlData);

  if (!$xmlObject) {
      http_response_code(400);
      echo json_encode(["error" => "El XML recibido no es válido."]);
      exit;
  }
  else{

    $curl = curl_init();

    $username = "int_test_ocs";
    $password = 'ocs_qad.2025$_';

    $authHeader = "Authorization: Basic " . base64_encode("$username:$password");


    // Convertir el XML en un JSON válido
    $jsonData = json_encode(["xml" => $xmlData], JSON_HEX_QUOT);
    $data = json_decode($jsonData, true);

    // Obtener el XML como string con comillas escapadas
    $xmlDataFormateado = json_encode($data["xml"]);

    curl_setopt_array($curl, array(
      CURLOPT_URL => 'http://201.236.140.195:8030/pilo/rest/piloService/ocsqad',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS =>'xmldata='.$xmlDataFormateado,
      CURLOPT_HTTPHEADER => array(
        'Content-Type: application/x-www-form-urlencoded',
        $authHeader
      ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    echo $response;

  }
?>
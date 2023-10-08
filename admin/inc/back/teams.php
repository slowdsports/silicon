<?php

// URL de la API y parámetros de solicitud
$url = 'https://www.fotmob.com/api/leagues?id=47&ccode3=HND';

// Inicializar cURL y establecer opciones de solicitud
$curl = curl_init($url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

// Ejecutar la solicitud y decodificar la respuesta JSON
$response = curl_exec($curl);
$data = json_decode($response);
//var_dump($data);

// Manejar errores de cURL
if ($response === false) {
    $error = curl_error($curl);
    echo 'Error: ' . $error;
}

// Cerrar la conexión cURL
curl_close($curl);

// Conectarse a la base de datos MySQL
include('conn.php');

// Iterar a través de los datos de los partidos y guardarlos en la base de datos
// Equipos
foreach ($data->details as $team) {
    $team_id = $team -> ccode;
    $team_name = $team -> name;
    echo $team_id;
}

// Cerrar la conexión a la base de datos
mysqli_close($conn);

?>
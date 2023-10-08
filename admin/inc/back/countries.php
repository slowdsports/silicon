<?php

// URL de la API y parámetros de solicitud
$url = 'https://www.fotmob.com/api/allLeagues';

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
// Ligas
foreach ($data->countries as $country) {
    $country_id = $country -> ccode;
    $country_name = $country -> name;
    $query = "INSERT INTO paises (paisCodigo, paisNombre) VALUES ('$country_id', '$country_name')";
    mysqli_query($conn, $query);
    echo $query .";";
    // if ($query) {
    //     echo "Se insertaron los juegos";
    // } else {
    //     echo "Error al insertar los juegos";
    // }
}

// Cerrar la conexión a la base de datos
mysqli_close($conn);

?>
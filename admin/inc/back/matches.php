<?php

// URL de la API y parámetros de solicitud
if (isset($_GET['date'])) {
    $date = $_GET['date'];
    $url = 'https://www.fotmob.com/api/matches?date='.$date.'&timezone=America%2FTegucigalpa&ccode3=HND';    
} else {
    $url = 'https://www.fotmob.com/api/matches?timezone=America%2FTegucigalpa&ccode3=HND';
}


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
foreach ($data->leagues as $league) {
    $league_id = $league -> id;
    $league_name = $league -> name;
    // Partidos
    foreach ($league->matches as $match) {
        $game_id = $match -> id;
        $game_date = $match -> time;
            $game_date = str_replace(".", "-", $game_date);
            $day = substr($game_date, '0', '2');
            $month = substr($game_date, '3', '2');
            $year = substr($game_date, '6', '4');
            $hours = substr($game_date, '11', '5');
            $game_date = $year . "-" . $month . "-" . $day . " " . $hours;
        // Local
        $local_id = $match->home->id;
        $local = $match->home->name;
        $visita_id = $match->away->id;
        $visita = $match->away->name;
        $query1 = "INSERT INTO equipos (equipoId, equipoNombre, equipoLiga) VALUES ('$local_id', '$local', '$league_id')";
        $query2 = "INSERT INTO equipos (equipoId, equipoNombre, equipoLiga) VALUES ('$visita_id', '$visita', '$league_id')";
        $query3 = "INSERT INTO partidos (id, local, visitante, liga, fecha_hora) VALUES ('$game_id', '$local_id', '$visita_id', '$league_id', '$game_date')";
        mysqli_query($conn, $query1);
        echo $query1;
        mysqli_query($conn, $query2);
        echo $query2;
        mysqli_query($conn, $query3);
        echo $query3;
    }
}

// Cerrar la conexión a la base de datos
mysqli_close($conn);

?>
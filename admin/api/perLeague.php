<?php
include('../conn.php');
if (!isset($_POST['filtrarLiga'])) {
    $apiLeague = $_GET['filtrarLiga'];
} else {
    $apiLeague = $_POST['filtrarLiga'];
}
$i=0;
if ($apiLeague):
    // Season Info
    $apiSeason = "https://api.sofascore.com/api/v1/unique-tournament/".$apiLeague."/seasons";
    $data = file_get_contents($apiSeason);
    $jsonData = json_decode($data, true);
    $seasonId = $jsonData['seasons'][0]['id'];
    // Games Info
    $apiUrl = "https://api.sofascore.com/api/v1/unique-tournament/".$apiLeague."/season/".$seasonId."/events/next/0";
    $data = file_get_contents($apiUrl);
    $jsonData = json_decode($data, true);
    // Recorrer Data y guardar en DB
    foreach($jsonData['events'] as $event) {
        // Country Info
        $country = $event['tournament']['uniqueTournament']['category']['slug'];
        $country_insert = "INSERT INTO `paises`(`paisCodigo`, `paisNombre`) VALUES ('$country', '$country')";
        mysqli_query($conn, $country_insert);
        $country = $event['tournament']['uniqueTournament']['category']['slug'];
            // Tournament Info
            $tournament_id = $event['tournament']['uniqueTournament']['id'];
            $tournament_name = $event['tournament']['name'];
            $tournament_sname = $event['tournament']['slug'];
            $sport_id = $event['tournament']['uniqueTournament']['category']['sport']['id'];
            $sport = $event['tournament']['uniqueTournament']['category']['sport']['slug'];
            // Volcado base de datos
            $tournament_insert = "INSERT INTO `ligas`(`ligaId`, `ligaNombre`, `ligaImg`, `ligaPais`, `season`) VALUES ($tournament_id, '$tournament_name', '$tournament_sname', '$country', '$seasonId')";
            mysqli_query($conn, $tournament_insert);
                // Teams Info
                $home_id = $event['homeTeam']['id'];
                $home_name = $event['homeTeam']['name'];
                $home_sname = $event['homeTeam']['shortName'];
                $home_insert = "INSERT INTO `equipos`(`equipoId`, `equipoNombre`, `equipoImg`, `equipoLiga`) VALUES ($home_id, '$home_name', null, $tournament_id)";
                mysqli_query($conn, $home_insert);
                $away_id = $event['awayTeam']['id'];
                $away_name = $event['awayTeam']['name'];
                $away_sname = $event['awayTeam']['shortName'];
                $home_name = str_replace("'","",$home_name);
                $away_name = str_replace("'","",$away_name);
                $away_insert = "INSERT INTO `equipos`(`equipoId`, `equipoNombre`, `equipoImg`, `equipoLiga`) VALUES ($away_id, '$away_name', null, $tournament_id)";
                mysqli_query($conn, $away_insert);
                    // Game Info
                    $i++;
                    $game_id = $event['id'];
                    $date = date('Y-m-d H:i:s', $event['startTimestamp']);
                    // Canales por defecto por liga
                        // Liga PRO [Ecuador]
                        if ($tournament_id == 240) {
                            $canal1 = 60;
                            $game_insert = "INSERT INTO `partidos`(`id`, `local`, `visitante`, `liga`, `fecha_hora`, `tipo`, `canal1`) VALUES ($game_id, $home_id, $away_id, $tournament_id, '$date', '$sport', '$canal1')";
                            // Primera A [Colombia]
                        } elseif ($tournament_id == 11539) {
                            $canal1 = 59;
                            $game_insert = "INSERT INTO `partidos`(`id`, `local`, `visitante`, `liga`, `fecha_hora`, `tipo`, `canal1`) VALUES ($game_id, $home_id, $away_id, $tournament_id, '$date', '$sport', '$canal1')";
                        }
                    $game_insert = "INSERT INTO `partidos`(`id`, `local`, `visitante`, `liga`, `fecha_hora`, `tipo`) VALUES ($game_id, $home_id, $away_id, $tournament_id, '$date', '$sport')";
                    mysqli_query($conn, $game_insert);
                    if (mysqli_query($conn, $game_insert)) {
                        echo "Se agregaron " .$i. " partidos de " . $tournament_name;
                    }
                    // echo "Date and Time: " . $date . "<br>";
                    // echo "Team 1 ID: " . $home_id . "<br>";
                    // echo "Team 1 Name: " . $home_name . "<br>";
                    // echo "Team 2 ID: " . $away_id . "<br>";
                    // echo "Team 2 Name: " . $away_name . "<br><br>";
    }
endif;
?>
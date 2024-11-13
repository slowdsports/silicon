<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
// Cargar los archivos JSON
$latamJson = file_get_contents('/home/u5233116/web/inc/componentes/guia/json/latam.json');
$spainJson = file_get_contents('/home/u5233116/web/inc/componentes/guia/json/spain.json');

// Decodificar los JSON a arreglos asociativos
$latamData = json_decode($latamJson, true);
$spainData = json_decode($spainJson, true);

// Combinar los datos sin agregar un nuevo nivel
$combinedData = array_merge($latamData, $spainData);

// Codificar el nuevo arreglo a JSON
$programacionJson = json_encode($combinedData, JSON_PRETTY_PRINT);

// Guardar el nuevo JSON en un archivo
file_put_contents('/home/u5233116/web/inc/componentes/guia/json/programacion.json', $programacionJson);

echo "La programacion ha sido guardada en json/programacion.json.";
?>
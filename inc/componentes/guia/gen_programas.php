<?php
// Cargar los archivos JSON
$latamJson = file_get_contents('json/latam.json');
$spainJson = file_get_contents('json/spain.json');

// Decodificar los JSON a arreglos asociativos
$latamData = json_decode($latamJson, true);
$spainData = json_decode($spainJson, true);

// Combinar los datos sin agregar un nuevo nivel
$combinedData = array_merge($latamData, $spainData);

// Codificar el nuevo arreglo a JSON
$programacionJson = json_encode($combinedData, JSON_PRETTY_PRINT);

// Guardar el nuevo JSON en un archivo
file_put_contents('json/programacion.json', $programacionJson);

echo "La programación ha sido guardada en json/programacion.json.";
?>
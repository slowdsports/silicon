<?php
//ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
// Conexión a la base de datos
include('conn.php');
//include('../conn.php');

## AGENDA
$resultado = mysqli_query($conn, "SELECT p.id, p.local, p.visitante, p.liga, p.fecha_hora, p.tipo, p.starp, p.hbom, 
e1.equipoId AS id_local, e1.equipoNombre AS equipo_local,
e2.equipoId AS id_visitante, e2.equipoNombre AS equipo_visitante,
e3.ligaNombre AS partido_liga,
c1.canalId AS id_canal1, c1.canalNombre AS nombre_canal1,
p1.paisNombre AS pais_canal1,
c2.canalId AS id_canal2, c2.canalNombre AS nombre_canal2,
p2.paisNombre AS pais_canal2,
c3.canalId AS id_canal3, c3.canalNombre AS nombre_canal3,
p3.paisNombre AS pais_canal3,
c4.canalId AS id_canal4, c4.canalNombre AS nombre_canal4,
p4.paisNombre AS pais_canal4,
c5.canalId AS id_canal5, c5.canalNombre AS nombre_canal5,
p5.paisNombre AS pais_canal5,
c6.canalId AS id_canal6, c6.canalNombre AS nombre_canal6,
p6.paisNombre AS pais_canal6,
c7.canalId AS id_canal7, c7.canalNombre AS nombre_canal7,
p7.paisNombre AS pais_canal7,
c8.canalId AS id_canal8, c8.canalNombre AS nombre_canal8,
p8.paisNombre AS pais_canal8,
c9.canalId AS id_canal9, c9.canalNombre AS nombre_canal9,
p9.paisNombre AS pais_canal9,
c10.canalId AS id_canal10, c10.canalNombre AS nombre_canal10,
p10.paisNombre AS pais_canal10
FROM partidos p
JOIN equipos e1 ON p.local = e1.equipoId
JOIN equipos e2 ON p.visitante = e2.equipoId
JOIN ligas e3 ON p.liga = e3.ligaId
LEFT JOIN canales c1 ON p.canal1 = c1.canalId
LEFT JOIN paises p1 ON c1.canalPais = p1.paisId
LEFT JOIN canales c2 ON p.canal2 = c2.canalId
LEFT JOIN paises p2 ON c1.canalPais = p2.paisId
LEFT JOIN canales c3 ON p.canal3 = c3.canalId
LEFT JOIN paises p3 ON c1.canalPais = p3.paisId
LEFT JOIN canales c4 ON p.canal4 = c4.canalId
LEFT JOIN paises p4 ON c1.canalPais = p4.paisId
LEFT JOIN canales c5 ON p.canal5 = c5.canalId
LEFT JOIN paises p5 ON c1.canalPais = p5.paisId
LEFT JOIN canales c6 ON p.canal6 = c6.canalId
LEFT JOIN paises p6 ON c1.canalPais = p6.paisId
LEFT JOIN canales c7 ON p.canal7 = c7.canalId
LEFT JOIN paises p7 ON c1.canalPais = p7.paisId
LEFT JOIN canales c8 ON p.canal8 = c8.canalId
LEFT JOIN paises p8 ON c1.canalPais = p8.paisId
LEFT JOIN canales c9 ON p.canal9 = c9.canalId
LEFT JOIN paises p9 ON c1.canalPais = p9.paisId
LEFT JOIN canales c10 ON p.canal10 = c10.canalId
LEFT JOIN paises p10 ON c1.canalPais = p10.paisId
ORDER BY
fecha_hora asc
");
// Convertir los datos a formato JSON
$datos = array();
$i;
while ($fila = mysqli_fetch_assoc($resultado)) {
    $i++;
    $datos[] = $fila;
}
$json = json_encode($datos);
// Guardar el archivo JSON
file_put_contents('../json/agenda.json', $json);
//var_dump($json);
$partidosContar = mysqli_num_rows($resultado);

## EQUIPOS
$i;
// Consulta a la tabla
$resultado = mysqli_query($conn, "SELECT * FROM equipos
INNER JOIN ligas ON equipos.equipoLiga = ligas.ligaId");
// Convertir los datos a formato JSON
$datos = array();
$i = 0;
while ($fila = mysqli_fetch_assoc($resultado)) {
    $i++;
    $datos[] = $fila;
}
$json = json_encode($datos);
// Guardar el archivo JSON
file_put_contents('../json/equipos.json', $json);
// var_dump($json);
$equiposContar = mysqli_num_rows($resultado);


## LIGAS
$i;
// Consulta a la tabla
$resultado = mysqli_query($conn, "SELECT * FROM ligas");
// Convertir los datos a formato JSON
$datos = array();
$i = 0;
while ($fila = mysqli_fetch_assoc($resultado)) {
    $i++;
    $datos[] = $fila;

    $json = json_encode($datos);
    // Guardar el archivo JSON
    file_put_contents('../json/ligas.json', $json);
    // var_dump($json);
    $ligasContar = mysqli_num_rows($resultado);


    ## CANALES
    $i;
    // Consulta a la tabla
    $resultado = mysqli_query($conn, "SELECT c.canalId, c.canalNombre, c.canalImg, c.canalCategoria, c.canalPais,
    p1.paisNombre AS pais_canal
    FROM canales c
    LEFT JOIN paises p1 ON c.canalPais = p1.paisId");
    // Convertir los datos a formato JSON
    $datos = array();
    while ($fila = mysqli_fetch_assoc($resultado)) {
        $i++;
        $datos[] = $fila;
    }
    $json = json_encode($datos);
    // Guardar el archivo JSON
    file_put_contents('../json/canales.json', $json);
    // var_dump($json);
    $canalesContar = mysqli_num_rows($resultado);


    ## PAISES
    $i;
    // Consulta a la tabla
    $resultado = mysqli_query($conn, "SELECT * FROM paises");
    // Convertir los datos a formato JSON
    $datos = array();
    $i = 0;
    while ($fila = mysqli_fetch_assoc($resultado)) {
        $i++;
        $datos[] = $fila;
    }
    $json = json_encode($datos);
    // Guardar el archivo JSON
    file_put_contents('../json/paises.json', $json);
    // var_dump($json);
    $paisesContar = mysqli_num_rows($resultado);

    ## CATEGORIAS
    $i;
    // Consulta a la tabla
    $resultado = mysqli_query($conn, "SELECT * FROM categorias");
    // Convertir los datos a formato JSON
    $datos = array();
    $i = 0;
    while ($fila = mysqli_fetch_assoc($resultado)) {
        $i++;
        $datos[] = $fila;
    }
    $json = json_encode($datos);
    // Guardar el archivo JSON
    file_put_contents('../json/categorias.json', $json);
    // var_dump($json);
    $categoriasContar = mysqli_num_rows($resultado);

    $i;
    // Consulta a la tabla
    $resultado = mysqli_query($conn, "SELECT * FROM tipos");
    // Convertir los datos a formato JSON
    $datos = array();
    while ($fila = mysqli_fetch_assoc($resultado)) {
        $i++;
        $datos[] = $fila;
    }
    $json = json_encode($datos);
    // Guardar el archivo JSON
    file_put_contents('../json/tipos.json', $json);
    // var_dump($json);
    $tiposContar = mysqli_num_rows($resultado);
}
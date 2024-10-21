<?php
if(isset($_GET['p']) && $_GET['p'] == 401){ require_once('error.php'); exit();}
//error_reporting(E_ALL);
//ini_set('display_errors', '1');
include('inc/conn.php');
include('inc/header.php');
echo '<div id="notificacion"></div>';
// Nav
if(isset($_GET['p'])) {
    // Escapar caracteres peligrosos
    $paginaSolicitada = basename($_GET['p']);
    // Ruta al directorio de páginas
    $rutaDirectorio = __DIR__ . '/';
    // Verificar
    if(file_exists($rutaDirectorio . $paginaSolicitada . ".php")) {
        // Si existe, cárgala
        include($rutaDirectorio . $paginaSolicitada . ".php");
    } else {
        // Si no existe, 404.php
        //echo "No existe";
        include("404.php");
    }
} elseif (isset($_GET['updateChannels'])) {
    // Consulta SQL para obtener los datos
    $sql = "SELECT f.`fuenteId`, f.`fuenteNombre`, f.`canal`, f.`pais`, f.`status`, f.`tipo`, c.`canalImg`, c.`canalCategoria`, c2.`categoriaNombre`, p.`paisNombre`
            FROM `fuentes` f
            JOIN `canales` c ON f.`canal` = c.`canalId`
            JOIN `categorias` c2 ON c.`canalCategoria` = c2.`categoriaId`
            JOIN `paises` p ON f.`pais` = p.`paisId`
            WHERE f.`status` = 1";
    $result = $conn->query($sql);

    if (!$result) {
        die("Error en la consulta: " . $conn->error);
    }

    $canales = [];
    $canales_ios = [];

    while ($row = $result->fetch_assoc()) {
        $canalId = (string) $row['canal'];  // Forzar $canalId a string

        // Debug
        echo "Procesando canal ID: " . $canalId . "<br>";
        print_r($row);
        if (!array_key_exists($canalId, $canales)) {
            $canales[$canalId] = array_map('utf8_encode', $row);
        }
        // iOS
        if ($row['tipo'] != 9 && $row['tipo'] != 11) {
            $canales_ios[$canalId] = array_map('utf8_encode', $row);
        }
    }

    // Convertir arrays a JSON y guardar en archivos
    if (!empty($canales)) {
        $jsonData = json_encode(array_values($canales), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        file_put_contents('json/canales.json', $jsonData);
        echo "Archivo canales.json guardado.<br>";
    } else {
        echo "No hay canales para guardar en el archivo JSON.<br>";
    }

    if (!empty($canales_ios)) {
        $jsonData_ios = json_encode(array_values($canales_ios), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        file_put_contents('json/canales_ios.json', $jsonData_ios);
        echo "Archivo canales_ios.json guardado.<br>";
    } else {
        echo "No hay canales iOS para guardar en el archivo JSON.<br>";
    }
}
 else {
    // Default
    include("home.php");
}
// Footer
include('inc/footer.php');

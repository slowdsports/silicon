<?php
if(isset($_GET['p']) && $_GET['p'] == 401){ require_once('401.php'); exit();}
// error_reporting(E_ALL);
// ini_set('display_errors', '1');
// BD
include('inc/conn.php');
// Header
include('inc/header.php');
echo '<div id="notificacion"></div>';
// Navegación
// Parámetro "p" del método GET
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
        echo "No existe";
        //include("404.php");
    }
} else {
    // Si no se proporciona ningún parámetro, carga la página predeterminada (index.php)
    include("home.php");
}
// Footer
include('inc/footer.php');
<?php
$host = 'localhost'; // El nombre del servidor de la base de datos
$user = 'root'; // El nombre de usuario de la base de datos
$password = 'root'; // La contraseña de la base de datos
$database = 'besoccer'; // El nombre de la base de datos
$conn = mysqli_connect($host, $user, $password, $database);

 //Verificar si la conexión fue exitosa
if (mysqli_connect_errno()) {
    printf("Falló la conexión: ", mysqli_connect_error());
    exit();
}
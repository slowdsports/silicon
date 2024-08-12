<?php
include('inc/conn.php');
// Obtener el parámetro GET "f"
$fuente = isset($_GET['f']) ? $_GET['f'] : null;

// Verificar si el parámetro no está vacío
if ($fuente !== null) {
    // Escapar el parámetro para evitar inyecciones SQL
    $fuente = $conn->real_escape_string($fuente);
    
    // Insertar el nuevo registro en la tabla "reports"
    $sql = "INSERT INTO reports (fuente, fecha) VALUES ('$fuente', NOW())";

    if ($conn->query($sql) === TRUE) {
        echo "Nueva fila agregada correctamente.";
    } else {
        echo "Error al agregar la fila: " . $conn->error;
    }
} else {
    echo "El parámetro 'f' es requerido.";
}

// Cerrar la conexión
$conn->close();
?>

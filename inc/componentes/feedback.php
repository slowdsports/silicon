<?php
include ('../conn.php');
ini_set('error_reporting', E_ALL);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener datos del POST
    $fuenteId = intval($_POST['fuenteId']);
    $ip = $_POST['ip'];
    $action = $_POST['action'];

    if ($action === 'reporte') {
        // Lógica para agregar un reporte
        $comentario = $_POST['comentario'];

        // Insertar el reporte en la base de datos
        $insertQuery = "INSERT INTO reportes (fuente, ip, fecha, comentario) VALUES (?, ?, NOW(), ?)";
        $insertStmt = $conn->prepare($insertQuery);
        $insertStmt->bind_param("iss", $fuenteId, $ip, $comentario);

        if ($insertStmt->execute()) {
            echo "Reporte enviado correctamente";
        } else {
            echo "Error al enviar el reporte: " . $insertStmt->error;
        }

        $insertStmt->close();
    } else {
        // Verificar si ya existe un voto para esta IP y canal
        $query = "SELECT id FROM votos WHERE ip = ? AND canal_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("si", $ip, $fuenteId);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            // Si ya existe un like, eliminarlo
            $deleteQuery = "DELETE FROM votos WHERE ip = ? AND canal_id = ?";
            $deleteStmt = $conn->prepare($deleteQuery);
            $deleteStmt->bind_param("si", $ip, $fuenteId);

            if ($deleteStmt->execute()) {
                echo "Like eliminado correctamente";
            } else {
                echo "Error al eliminar el like: " . $deleteStmt->error;
            }

            $deleteStmt->close();
        } else {
            // Si no existe, insertar un nuevo like
            $insertQuery = "INSERT INTO votos (ip, canal_id, voto) VALUES (?, ?, 'like')";
            $insertStmt = $conn->prepare($insertQuery);
            $insertStmt->bind_param("si", $ip, $fuenteId);

            if ($insertStmt->execute()) {
                echo "Like guardado correctamente";
            } else {
                echo "Error al guardar el like: " . $insertStmt->error;
            }

            $insertStmt->close();
        }

        $stmt->close();
    }

} elseif ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['fuenteId'])) {
    $fuenteId = intval($_GET['fuenteId']);

    if (isset($_GET['action']) && $_GET['action'] === 'getReportes') {
        // Contar la cantidad de reportes para el canal
        $query = "SELECT COUNT(*) as total_reportes FROM reportes WHERE fuente = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $fuenteId);
        $stmt->execute();
        $stmt->bind_result($totalReportes);
        $stmt->fetch();

        echo $totalReportes;

        $stmt->close();
    } else {
        // Contar la cantidad de likes para el canal
        $query = "SELECT COUNT(*) as total_likes FROM votos WHERE canal_id = ? AND voto = 'like'";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $fuenteId);
        $stmt->execute();
        $stmt->bind_result($totalLikes);
        $stmt->fetch();

        echo $totalLikes;

        $stmt->close();
    }
}

$conn->close();
?>

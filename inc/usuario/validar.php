<?php
function validarSuscripcion() {
    if (!isset($_COOKIE['usuario_id']) || !isset($_COOKIE['usuario_rol'])) {
        return false;  // No está logueado o no es VIP
    } else {
        //include($_SERVER['DOCUMENT_ROOT']. '/inc/conn.php');
        include(__DIR__ . '/../conn.php');
        $usId = $_COOKIE['usuario_id'];
        $usQuery = mysqli_query($conn, "SELECT id, rol_id, suscripcion FROM usuarios WHERE id = '$usId'");
        $result = mysqli_fetch_array($usQuery);
        $suscripcion = $result['suscripcion'];
        $fecha_actual = new DateTime();
        $fecha_suscripcion = new DateTime($suscripcion);
        if ($fecha_suscripcion > $fecha_actual) {
            return true;  // Suscripción activa
        } else {
            return false;  // Suscripción ha expirado
        }
    }
}
?>

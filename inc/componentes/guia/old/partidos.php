<?php
include('../../conn.php');
// Obtener la fecha actual
date_default_timezone_set('Europe/Madrid');
$date = date('Y/m/d H:i:s');
$mm_0 = substr($date, 5, 2);
$dd_0 = substr($date, 8, 2);
$hh_0 = substr($date, 11, 2);
$m_0 = substr($date, 14, 2);

// Consulta a la base de datos
$query = "SELECT p.id, p.local, p.visitante, p.liga, p.fecha_hora, p.tipo, p.starp, p.vix, 
    e1.equipoId AS id_local, e1.equipoNombre AS equipo_local,
    e2.equipoId AS id_visitante, e2.equipoNombre AS equipo_visitante,
    e3.ligaNombre AS partido_liga,
    c1.canalNombre AS nombre_canal1, c2.canalNombre AS nombre_canal2, c3.canalNombre AS nombre_canal3,
    c4.canalNombre AS nombre_canal4, c5.canalNombre AS nombre_canal5, c6.canalNombre AS nombre_canal6,
    c7.canalNombre AS nombre_canal7, c8.canalNombre AS nombre_canal8, c9.canalNombre AS nombre_canal9, 
    c10.canalNombre AS nombre_canal10
    FROM partidos p
    JOIN equipos e1 ON p.local = e1.equipoId
    JOIN equipos e2 ON p.visitante = e2.equipoId
    JOIN ligas e3 ON p.liga = e3.ligaId
    LEFT JOIN canales c1 ON p.canal1 = c1.canalId
    LEFT JOIN canales c2 ON p.canal2 = c2.canalId
    LEFT JOIN canales c3 ON p.canal3 = c3.canalId
    LEFT JOIN canales c4 ON p.canal4 = c4.canalId
    LEFT JOIN canales c5 ON p.canal5 = c5.canalId
    LEFT JOIN canales c6 ON p.canal6 = c6.canalId
    LEFT JOIN canales c7 ON p.canal7 = c7.canalId
    LEFT JOIN canales c8 ON p.canal8 = c8.canalId
    LEFT JOIN canales c9 ON p.canal9 = c9.canalId
    LEFT JOIN canales c10 ON p.canal10 = c10.canalId
    WHERE MONTH(p.fecha_hora) = $mm_0 AND DAY(p.fecha_hora) = $dd_0
    ORDER BY fecha_hora ASC";

$result = mysqli_query($conn, $query);

// Crear un array para almacenar los resultados
$partidos = [];

while ($row = mysqli_fetch_assoc($result)) {
    $partidos[] = [
        'id' => $row['id'],
        'equipo_local' => $row['equipo_local'],
        'id_local' => $row['id_local'],
        'equipo_visitante' => $row['equipo_visitante'],
        'id_visitante' => $row['id_visitante'],
        'id_liga' => $row['liga'],
        'liga' => $row['partido_liga'],
        'fecha_hora' => $row['fecha_hora'],
        'tipo' => $row['tipo'],
        'canales' => [
            $row['nombre_canal1'],
            $row['nombre_canal2'],
            $row['nombre_canal3'],
            $row['nombre_canal4'],
            $row['nombre_canal5'],
            $row['nombre_canal6'],
            $row['nombre_canal7'],
            $row['nombre_canal8'],
            $row['nombre_canal9'],
            $row['nombre_canal10']
        ]
    ];
}

// Convertir el array en formato JSON
$json_data = json_encode($partidos, JSON_PRETTY_PRINT);

// Guardar el archivo JSON
file_put_contents('json/partidos.json', $json_data);

// Cerrar la conexión
mysqli_close($conn);

echo "Archivo JSON creado correctamente.";
?>

<?php
// Lógica para evitar carga directa
if (!isset($_SERVER['HTTP_REFERER']) || empty($_SERVER['HTTP_REFERER'])) {
    include('../../401.php');
    exit();
}
// Obtener el epg_id desde el parámetro GET
$epg_id = isset($_GET['epg_id']) ? $_GET['epg_id'] : '';
$option_index = isset($_GET['index']) ? (int)$_GET['index'] : 0;

header('Content-Type: application/json');

if ($epg_id) {
    // URL del JSON
    $json_url = 'https://www.tdtchannels.com/lists/tv.json';

    // Obtener el contenido del JSON
    $json_content = file_get_contents($json_url);

    // Decodificar el JSON
    $data = json_decode($json_content, true);

    // Inicializar la variable para el URL
    $stream_url = null;

    // Recorrer los países y canales para encontrar el epg_id
    foreach ($data['countries'] as $country) {
        foreach ($country['ambits'] as $ambit) {
            foreach ($ambit['channels'] as $channel) {
                if ($channel['epg_id'] === $epg_id) {
                    // Verificar si la opción especificada existe
                    if (isset($channel['options'][$option_index]['url'])) {
                        $stream_url = $channel['options'][$option_index]['url'];
                    }
                    break 3;
                }
            }
        }
    }

    if ($stream_url) {
        echo json_encode(['url' => $stream_url]);
    } else {
        echo json_encode(['error' => 'No se encontró el canal o el índice proporcionado.']);
    }
} else {
    echo json_encode(['error' => 'Por favor, proporciona un parámetro.']);
}
?>

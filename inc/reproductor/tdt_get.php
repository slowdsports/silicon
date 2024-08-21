<?php
// Obtener los parámetros GET
$epg_id = isset($_GET['epg_id']) ? $_GET['epg_id'] : '';
$id_canal = isset($_GET['id']) ? (int)$_GET['id'] : '';
$option_index = isset($_GET['index']) ? (int)$_GET['index'] : 0;

header('Content-Type: application/json');

// Validar si se proporcionó alguno de los parámetros
if ($epg_id || $id_canal) {
    // URL del nuevo JSON
    $json_url = '../../json/tdt.json';

    // Obtener el contenido del JSON
    $json_content = file_get_contents($json_url);

    // Decodificar el JSON
    $data = json_decode($json_content, true);

    // Inicializar la variable para la URL del stream
    $stream_url = null;

    // Recorrer los países y canales para encontrar el epg_id o id
    foreach ($data['countries'] as $country) {
        foreach ($country['ambits'] as $ambit) {
            foreach ($ambit['channels'] as $channel) {
                // Buscar por epg_id si está definido
                if ($epg_id && $channel['epg_id'] === $epg_id) {
                    // Verificar si la opción especificada existe
                    if (isset($channel['options'][$option_index]['url'])) {
                        $stream_url = $channel['options'][$option_index]['url'];
                    }
                    break 3;
                }

                // Buscar por id si está definido
                if ($id_canal && isset($channel['id']) && $channel['id'] === $id_canal) {
                    // Verificar si la opción especificada existe
                    if (isset($channel['options'][$option_index]['url'])) {
                        $stream_url = $channel['options'][$option_index]['url'];
                    }
                    break 3;
                }
            }
        }
    }

    // Retornar la URL del stream o un mensaje de error
    if ($stream_url) {
        echo json_encode(['url' => $stream_url]);
    } else {
        echo json_encode(['error' => 'No se encontró el canal o el índice proporcionado.']);
    }
} else {
    echo json_encode(['error' => 'Por favor, proporciona un parámetro válido.']);
}
?>
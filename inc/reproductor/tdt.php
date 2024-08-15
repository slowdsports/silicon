<?php
// Obtener el epg_id desde el parámetro GET
$epg_id = isset($_GET['epg_id']) ? $_GET['epg_id'] : '';

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
                    // Obtener la primera opción de URL (formato m3u8)
                    if (isset($channel['options'][0]['url'])) {
                        $stream_url = $channel['options'][0]['url'];
                    }
                    break 3;
                }
            }
        }
    }

    if ($stream_url) {
        echo json_encode(['url' => $stream_url]);
    } else {
        echo json_encode(['error' => 'No se encontró un canal con el epg_id proporcionado.']);
    }
} else {
    echo json_encode(['error' => 'Por favor, proporciona un epg_id en el parámetro GET.']);
}
?>

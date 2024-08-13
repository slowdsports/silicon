<?php
require 'scraper.php'; // Ruta al archivo simple_html_dom.php

// Array de IDs de canales
$canales = [
    'hbo_argentina',
    'hbo_2_latinoamerica',
    // Agrega más IDs de canales aquí...
];

// URL base de los canales
$url_base = 'https://www.gatotv.com/canal/';

// Crear la carpeta json si no existe
if (!file_exists('json')) {
    mkdir('json', 0777, true);
}

foreach ($canales as $canal_id) {
    // Construir la URL completa del canal
    $url = $url_base . $canal_id;

    // Crear un objeto DOM a partir del contenido de la URL
    $html = file_get_html($url);

    // Array para almacenar los datos de programación
    $programas = [];

    // Buscar la tabla de programación
    $table = $html->find('table.tbl_EPG', 0);

    if ($table) {
        $rows = $table->find('tr');
        $current_period = '';

        foreach ($rows as $row) {
            // Verifica si el row es un encabezado de período
            $header = $row->find('th', 0);
            if ($header) {
                $current_period = trim($header->plaintext);
            }

            // Verifica si el row es una fila de datos
            $cells = $row->find('td');
            if (count($cells) >= 3) {
                $hora_inicio = $cells[0]->find('time', 0)->plaintext ?? '';
                $hora_fin = $cells[1]->find('time', 0)->plaintext ?? '';
                $titulo = '';
                $descripcion = '';
                $imagen = '';
                $enlace = '';
                $en_vivo = false;

                // Extrae el título, descripción, imagen y enlace
                if ($cells[2]->find('a', 0)) {
                    $titulo = $cells[2]->find('a', 0)->title;
                    $enlace = $cells[2]->find('a', 0)->href;
                    $imagen = $cells[2]->find('img', 0)->src ?? '';
                }
                if (count($cells) > 3 && $cells[3]->find('div.div_program_title_on_channel', 0)) {
                    $program_info = $cells[3]->find('div.div_program_title_on_channel', 0);
                    $titulo = $program_info->find('span', 0)->plaintext ?? '';
                    
                    // Obtén la descripción que está después del div.div_program_title_on_channel
                    $descripcion = trim($program_info->next_sibling()->plaintext) ?? '';
                }


                // Comprobar si este es el programa en vivo
                if ($row->class == 'tbl_EPG_row_selected') {
                    $en_vivo = true;
                }

                // Añadir los datos al array de programas
                $programas[] = [
                    'hora_inicio' => $hora_inicio,
                    'hora_fin' => $hora_fin,
                    'titulo' => $titulo,
                    'descripcion' => $descripcion,
                    'enlace' => $enlace,
                    'imagen' => $imagen,
                    'periodo' => $current_period,
                    'en_vivo' => $en_vivo
                ];
            }
        }
    }

    // Guardar los datos en un archivo JSON individual
    $data = [
        'canal' => $canal_id,
        'programas' => $programas
    ];
    file_put_contents('json/' . $canal_id . '.json', json_encode($data, JSON_PRETTY_PRINT));

    echo "Datos guardados en json/$canal_id.json\n";
}
?>

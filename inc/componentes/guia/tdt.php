<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

// Conexión a la base de datos
require '/home/u5855787/web/inc/conn.php';

// URL del archivo JSON externo de programación en vivo
$programacionUrl = "https://www.tdtchannels.com/epg/TV.json";

// Obtener la hora actual en formato de timestamp
$timestampActual = time();

// Obtener el contenido del archivo JSON de programación
$jsonProgramacion = file_get_contents($programacionUrl);
$programacion = json_decode($jsonProgramacion, true);
if (empty($programacion)) {
    die("El JSON de programación está vacío o no se pudo decodificar.");
}

// Consulta a la base de datos para obtener los canales
$query = "SELECT fuentes.fuenteId, fuentes.fuenteNombre, fuentes.epgCanal, fuentes.pais, paises.paisId, canales.canalId, canales.canalImg, paises.paisNombre, paises.paisCodigo, categorias.categoriaId, categorias.categoriaNombre FROM fuentes
INNER JOIN paises ON fuentes.pais = paises.paisId
INNER JOIN canales ON fuentes.canal = canales.canalId
INNER JOIN categorias ON canales.canalCategoria = categorias.categoriaId
WHERE epgCanal IS NOT NULL
AND pais = 32";

$result = mysqli_query($conn, $query);
if (!$result) {
    die("Error en la consulta: " . mysqli_error($conn));
}

// Verifica cuántos resultados hay
$num_rows = mysqli_num_rows($result);
echo "Número de canales encontrados: $num_rows\n";

$canales = [];

while ($row = mysqli_fetch_assoc($result)) {
    $canalId = $row['canalId'];
    $fuenteId = $row['fuenteId'];
    $fuenteNombre = $row['fuenteNombre'];
    $fuenteLogo = $row['canalImg'];
    $fuenteCategoria = $row['categoriaNombre'];
    $epgCanal = $row['epgCanal'];
    $paisNombre = strtolower($row['paisCodigo']);
    $paisFlag = strtolower($row['paisNombre']);

    // Solo agregar si no existe ya un registro para este canal
    if (!isset($canales[$epgCanal])) {
        foreach ($programacion as $canalProgramacion) {
            if ($canalProgramacion['name'] === $epgCanal) {
                $programasEnVivo = [];
                foreach ($canalProgramacion['events'] as $evento) {
                    if ($timestampActual >= $evento['hi'] && $timestampActual <= $evento['hf']) {
                        $programasEnVivo[] = [
                            'titulo' => $evento['t'],
                            'descripcion' => $evento['d'],
                            'imagen' => $evento['c'],
                            'hora_inicio' => date('H:i', $evento['hi']),
                            'hora_fin' => date('H:i', $evento['hf'])
                        ];
                    }
                }

                // Si hay programas en vivo, guardar la información en la estructura solicitada
                if (!empty($programasEnVivo)) {
                    $canales[$epgCanal][] = [
                        'id' => $fuenteId,
                        'canal' => $canalId,
                        'nombre' => $fuenteNombre,
                        'logo' => $fuenteLogo,
                        'categoria' => $fuenteCategoria,
                        'epgCanal' => $epgCanal,
                        'pais' => $paisNombre,
                        'flag' => $paisFlag,
                        'titulo' => $programasEnVivo[0]['titulo'],
                        'descripcion' => implode(' ', array_slice(explode(' ', $programasEnVivo[0]['descripcion']), 0, 45)),
                        'imagen' => $programasEnVivo[0]['imagen']
                    ];
                } else {
                    echo "No hay eventos en vivo para " . $fuenteNombre . ".\n";
                }
            }
        }
    }
}

// Guardar el resultado en un archivo JSON
if (!empty($canales)) {
    $canalesJson = json_encode($canales, JSON_PRETTY_PRINT);
    file_put_contents('/home/u5855787/web/inc/componentes/guia/json/spain.json', $canalesJson);
    echo "Se ha guardado la información de los canales con su programación en vivo en el archivo inc/componentes/guia/json/spain.json.";
} else {
    echo "No se encontraron canales con programación en vivo.\n";
}

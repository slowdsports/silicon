<?php
header("Content-Type: application/json");

// Paso 1: Verifica que se reciba el parámetro 'id'
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo json_encode(["error" => "El parámetro 'id' no está definido o está vacío."]);
    exit();
}

$id = $_GET['id'];
$url = "https://deporte.website/4jf0fg/{$id}";

// Paso 2: Inicializa cURL y realiza la solicitud
$curl = curl_init($url);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

// Establece los encabezados
$headers = array(   
   "Host: deporte.website",
   "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:100.0) Gecko/20100101 Firefox/100.0",
   "Referer: https://deporte.website/",
);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl, CURLOPT_HEADER, true);

// Ejecuta la solicitud
$resp = curl_exec($curl);

if ($resp === false) {
    echo json_encode(["error" => "Error en cURL: " . curl_error($curl)]);
} else {
    $header_size = curl_getinfo($curl, CURLINFO_HEADER_SIZE);
    $headers = substr($resp, 0, $header_size);
    $body = substr($resp, $header_size);

    // Guarda los encabezados para depuración
    file_put_contents("debug_headers.txt", $headers);
    file_put_contents("debug_body.html", $body);

    // Verifica si hay una redirección
    if (preg_match("/location: (https?.*)\r\n/", $headers, $matches)) {
        $redirect_url = trim($matches[1]);
        // Guarda la URL de redirección para depuración
        file_put_contents("debug_redirect_url.txt", $redirect_url);

        // Devuelve la URL redirigida
        echo json_encode(["hls" => base64_encode($redirect_url)]);
    } else {
        echo json_encode(["error" => "No se encontró redirección."]);
    }
}

curl_close($curl);
exit();
?>


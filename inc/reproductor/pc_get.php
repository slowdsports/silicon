<?php
header("Content-Type: application/json");

if(isset($_GET['id'])){
	
	$url = "https://deporte.lat/v8rh/{$_GET['id']}";

	$curl = curl_init($url);
	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

	$headers = array(	
	   "Host: deporte.lat",
	   "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:100.0) Gecko/20100101 Firefox/100.0",
	   "Referer: https://deporte.lat/",
	);
	curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
	curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

	$resp = curl_exec($curl);
	curl_close($curl);
	
	if ($resp) {
		// Usar una expresión regular para extraer la URL del .m3u8 dentro de <script>
		if (preg_match('/location\.href\s*=\s*"([^"]+\.m3u8[^"]*)"/', $resp, $matches)) {
			$m3u8_url = $matches[1];
			// Devolver la URL del archivo .m3u8 en formato JSON
			echo json_encode(["hls" => base64_encode($m3u8_url)]);
		} else {
			echo json_encode(["error" => "No se encontró la URL del archivo M3U8."]);
		}
	} else {
		echo json_encode(["error" => "No se pudo obtener el contenido de la página."]);
	}
	
	exit();
}

if(isset($_GET['all'])){
	$datos = file_get_contents("https://deporte.lat/v8rh/");
	
	preg_match_all('(href="(.*?)".*?>(.*?)<)', $datos, $data, PREG_SET_ORDER);
	
	$channels = [];
	foreach($data as $dato){
		$link = $dato[1]; // Este es el "href" de cada enlace
		$name = $dato[2]; // Este es el texto del enlace, es decir, el nombre del canal
		$server = "https://{$_SERVER['HTTP_HOST']}{$_SERVER['PHP_SELF']}";
		
		$channels[] = [
			"name" => $name,
			"url" => "{$server}?id={$link}"
		];
	}

	echo json_encode($channels);
	exit();
}
?>

<?php
// Deteccion de Dispositivo
include('../componentes/detect.php');
// Logica para evitar carga directa
if (!isset($_SERVER['HTTP_REFERER']) || empty($_SERVER['HTTP_REFERER'])) {
    include('../../401.php');
    exit();
} elseif (strpos($dispositivo, "iOS") || strpos($dispositivo, "iPhone")) {
    echo "<style> body { background-color: #000; color: #fff; } </style>";
    echo "<p>El tipo de canal al que intentas acceder no funciona en dispositivos iOS, por favor usa otra opcion o cambia de dispositivo.</p>";
    exit();
}
// ADS
include('../../inc/ads/intersticial.php');
// Share
include('share.php');
?>
<script> ConsoleBan.init({ redirect: '../../?p=401'}); </script>
<script src="../../inc/ads/popunder.php"></script>
<style>
    body {
        background-color: #000;
        color: #fff;
        margin: 0;
        padding: 0;
    }

    h1 {
        text-align: center;
    }

    .container {
        width: 100% !important;
        height: 100vh !important;
    }

    #player,
    #iframe {
        height: 100% !important;
        width: 100% !important;
        border: none;
    }

    .hidden {
        display: none;
    }
</style>
<div class="container">
    <div id="player"></div>
    <div id="alerta-extension" class="hidden"></div>
</div>
<script>
    function getQueryParam(param) {
        let urlParams = new URLSearchParams(window.location.search);
        return urlParams.get(param);
    }

    function isInstalled(installed, uninstalled){
        let img = document.createElement('img');
        img.onerror = uninstalled;
        img.onload = installed;
        img.src = 'chrome-extension://opmeopcambhfimffbomjgemehjkbbmji/play-on.png';
    }

    let rParam = getQueryParam('r');
    let alerta = document.getElementById("alerta-extension");
    console.log(alerta)
    if (rParam) {
        isInstalled(
            // Installed
            () => {
                // Your code when detected extension is installed
                let iframe = document.getElementById("player");
                iframe.innerHTML = `<iframe width="100%" height="100%" allow="encrypted-media" allowfullscreen src="chrome-extension://opmeopcambhfimffbomjgemehjkbbmji/pages/player.html#${decodeURIComponent(rParam)}"></iframe>`;
            },
            // Uninstalled
            () => {
                // Your code when detected extension is uninstalled
                alerta.innerHTML = `Debes instalar la extensión: <a href="#extension" target="_blank">Extensión HLS Player</a> para que estos canales funcionen`;
                alerta.classList.remove("hidden");
            }
        );
    } else {
        alert('No se ha proporcionado el parámetro r en la URL.');
    }
</script>

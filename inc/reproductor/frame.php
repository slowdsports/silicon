<?php
// Lógica para evitar carga directa
if (!isset($_SERVER['HTTP_REFERER']) || empty($_SERVER['HTTP_REFERER'])) {
    include('../../401.php');
    exit();
}
// ADS
include('../../inc/ads/intersticial.php');
// Share
include('share.php');
$canal = $_GET['c'];
include('../../inc/conn.php');
// Fuente Alterna
if (isset($_GET['f']) && $_GET['f'] !== null) {
    $canal = ($_GET['f']);
    $canales = mysqli_query($conn, "SELECT * FROM fuentes WHERE fuenteId = '$canal'");
    $result = mysqli_fetch_array($canales);
    $canalId = $result['canalId'];
    $canalNombre = $result['canalNombre'];
    $canalUrl = $result['canalUrl'];
    $key1 = $result['key'];
    $key2 = $result['key2'];
    $canalImg = $result['canalImg'];
    $canalCategoria = $result['canalCategoria'];
    $canalPais = $result['canalPais'];
    $canalTipo = $result['tipo'];
} elseif (isset($_GET['c']) && $_GET['c'] !== null) {
    $canal = ($_GET['c']);
    $canales = mysqli_query($conn, "SELECT * FROM canales WHERE canalId = '$canal'");
    $result = mysqli_fetch_array($canales);
    $canalId = $result['canalId'];
    $canalNombre = $result['canalNombre'];
    $canalUrl = $result['canalUrl'];
    $key1 = $result['key'];
    $key2 = $result['key2'];
    $canalImg = $result['canalImg'];
    $canalCategoria = $result['canalCategoria'];
    $canalPais = $result['canalPais'];
    $canalTipo = $result['canalTipo'];
}

// Especiales
$sandbox;
if (strpos($canalUrl, "streamtp") && isset($_GET['id'])) {
    $sandbox = "sandbox='allow-same-origin allow-scripts'";
} elseif (strpos($canalUrl, "bletcheanta") || strpos($canalUrl, "now.net") || strpos($canalUrl, "dlhd") || strpos($canalUrl, "betzta")) {
    $sandbox = "sandbox='allow-same-origin allow-scripts'";
}
?>
<script> ConsoleBan.init({ redirect: '../../?p=401' }); </script>
<?php if (!strpos($canalUrl, "tvfutbol")): ?>
<script src="../../inc/ads/popunder.php"></script>
<?php endif ?>
<style>
    body {
        background: #000;
        margin: 0;
        padding: 0;
    }

    .container {
        width: 100% !important;
        height: 100vh !important;
    }

    #player {
        height: 100% !important;
        width: 100% !important;
    }
</style>
<body>
    <div class="container">
        <iframe src="<?=$canalUrl?>" frameborder='0' scrolling='no' allowfullscreen allow='encrypted-media' <?=$sandbox?> id="player"></iframe>
    </div>
</body>

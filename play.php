<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
if (isset($_GET['c'])) {
    $canal = $_GET['c'];
    $canalTipo;
    $canalNombre;
    $channels = mysqli_query($conn, "SELECT * FROM canales
    INNER JOIN categorias ON canales.canalCategoria = categorias.categoriaId
    WHERE canalId = $canal");
    $result = mysqli_fetch_assoc($channels);
    $canalId = $result['canalId'];
    $canalImg = $result['canalImg'];
    $canalNombre = $result['canalNombre'];
    $canalCategoria = $result['categoriaNombre'];
    $categoria = $result['categoriaId'];
    $canalUrl = $result['canalUrl'];
    $canalPais = $result['canalPais'];
    $canalTipo = $result['canalTipo'];
    // Fuentes Alternas
    if (isset($_GET['f'])) {
        $canalAlt = $_GET['f'];
        $channels = mysqli_query($conn, "SELECT * FROM fuentes
        INNER JOIN canales ON fuentes.canal = canales.canalId
        INNER JOIN categorias ON canales.canalCategoria = categorias.categoriaId
        WHERE fuenteId = $canalAlt");
        $result = mysqli_fetch_assoc($channels);
        $canalId = $result['canal'];
        $canalImg = $result['canalImg'];
        $canalNombre = $result['canalNombre'];
        $canalCategoria = $result['categoriaNombre'];
        $categoria = $result['categoriaId'];
        $canalUrl = $result['canalUrl'];
        $canalPais = $result['canalPais'];
        $canalTipo = $result['tipo'];
    }
}
// iframes
if (isset($_GET['title'])) {
    $canalNombre = $_GET['title'];
}
?>


<section class="container mb-5 pt-4 pb-2 py-mg-4">
    <div class="row gy-4">

        <!-- Content -->
        <div class="col-lg-9">
            <h2 class="h4">
                Ver
                <?= ucwords($canalNombre) ?> En Vivo
            </h2>
            <!-- Reproductor -->
            <div class="gallery mb-4 pb-2">
                <div class="embed-responsive embed-responsive-16by9" id="playerContainer">
                    <?php
                    // Definir configuraciones para diferentes casos
                    $configurations = [
                        'r' => ["star.php", ['r', 'key', 'key2', 'img']],
                        's' => ["hbo.php", ['s', 'key', 'key2']],
                        'adult' => ["adult.php", []],
                        'nba' => ["", ['ifr']],
                        'nfl' => ["", ['ifr']],
                        'mlb' => ["", ['ifr']],
                        'evento' => ["", ['ifr']],
                        'hls' => ["hls.php", ['c']],
                        '11' => ["ckm.php", ['c', 'f']],
                        '12' => ["mplus.php", ['c', 'f']],
                        '9' => ["ck.php", ['c', 'f']],
                        '6' => ["bm.php", ['c', 'f']],
                        '1' => ["hls.php", ['c', 'f']],
                        '2' => ["", []] // For $canalTipo == 2, handle $canalUrl separately
                    ];

                    // Obtener el tipo de configuración según el caso
                    $type = null;
                    foreach ($_GET as $key => $value) {
                        if (isset($configurations[$key])) {
                            $type = $key;
                            break;
                        }
                    }

                    // Construir el iframe según el tipo de configuración
                    if ($type == '2' && isset($canalUrl)) {
                        $src = "class='embed-responsive-item' width='100%' height='100%' frameborder='0' scrolling='no' allowfullscreen allow-encrypted-media src='{$canalUrl}'";
                    } elseif ($type != null) {
                        $config = $configurations[$type];
                        $params = implode("&", array_map(function ($param) use ($config) {
                            return isset($_GET[$param]) ? "{$param}={$_GET[$param]}" : "";
                        }, $config[1]));

                        $src = "class='embed-responsive-item' width='100%' height='100%' frameborder='0' scrolling='no' allowfullscreen allow-encrypted-media src='inc/reproductor/{$config[0]}?{$params}'";
                    } else {
                        // Handle default case
                        $canalUrl = base64_decode($canalUrl);
                        $src = "class='embed-responsive-item' width='100%' height='100%' frameborder='0' scrolling='no' allowfullscreen allow-encrypted-media src='inc/reproductor/ck.php?c={$canal}" . (isset($canalAlt) ? "&f={$canalAlt}'" : "'");
                    }
                    // Manejar caso especial cuando se recibe el parámetro "ifr"
                    if (isset($_GET['ifr'])) {
                        $decodedIfr = base64_decode($_GET['ifr']);
                        // Validar la URL antes de mostrarla en el iframe
                        if (filter_var($decodedIfr, FILTER_VALIDATE_URL)) {
                            // Si la URL es válida, mostrarla en el iframe
                            $src = "class='embed-responsive-item' width='100%' height='100%' frameborder='0' scrolling='no' allowfullscreen allow-encrypted-media src='{$decodedIfr}'";
                        } else {
                            // Si la URL no es válida, mostrar un mensaje de error o redirigir a una página de error
                            $src = "class='embed-responsive-item' width='100%' height='100%' frameborder='0' scrolling='no' allowfullscreen allow-encrypted-media src='ruta/a/pagina/de/error'";
                        }
                    }

                    // Imprimir el iframe
                    echo "<iframe {$src}></iframe>";
                    ?>

                </div>
            </div>
            <hr class="mb-4">
        </div>

        <!-- Chat -->
        <div class="col-lg-3 position-relative">
            <div class="sticky-top " style="top: 105px !important;">
                <span class="d-block mb-3">
                    <svg class="me-2 mt-n1" xmlns="http://www.w3.org/2000/svg" width="24" height="25" fill="none">
                        <path
                            d="M20 12.5003v-1.707c0-4.44199-3.479-8.16099-7.755-8.28999-2.204-.051-4.251.736-5.816 2.256S4 8.31831 4 10.5003v2c-1.103 0-2 .897-2 2v4c0 1.103.897 2 2 2h2v-10c0-1.63699.646-3.16599 1.821-4.30599s2.735-1.739 4.363-1.691c3.208.096 5.816 2.918 5.816 6.28999v9.707h2c1.103 0 2-.897 2-2v-4c0-1.103-.897-2-2-2z"
                            fill="url(#A)"></path>
                        <path d="M7 12.5003h2v8H7v-8zm8 0h2v8h-2v-8z" fill="url(#A)"></path>
                        <defs>
                            <linearGradient id="A" x1="2" y1="11.5437" x2="22" y2="11.5437"
                                gradientUnits="userSpaceOnUse">
                                <stop offset="0" stop-color="#6366f1"></stop>
                                <stop offset=".5" stop-color="#8b5cf6"></stop>
                                <stop offset="1" stop-color="#d946ef"></stop>
                            </linearGradient>
                        </defs>
                    </svg>
                    Chat
                </span>
                <div class="rounded-3">
                    <iframe id="twitch-chat-embed" class="rounded-3"
                        src="https://www.twitch.tv/embed/iraffletv/chat?parent=127.0.0.1&parent=irtvhn.info&darkpopout"
                        height="560" width="100%">
                    </iframe>
                </div>
                <div class="row gy-4">
                    <div class="col-6">
                        <button disabled type="button" class="btn btn-sm btn-outline-secondary">
                            <i class="bx bx-like me-2 lead"></i>
                            Like
                            <span class="badge bg-primary shadow-primary mt-n1 ms-3">8</span>
                        </button>
                    </div>
                    <div class="col-6">
                        <button disabled type="button" class="btn btn-sm btn-outline-secondary">
                            <i class="bx bx-dislike me-2 lead"></i>
                            Dislike
                            <span class="badge bg-danger shadow-primary mt-n1 ms-3">4</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Relacionados -->
<?php include('inc/componentes/relacionados.php'); ?>

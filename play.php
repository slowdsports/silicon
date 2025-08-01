<?php
// error_reporting(E_ALL);
// ini_set('display_errors', '1');

// RADIO
if (isset($_GET['source'])) {
    include('inc/reproductor/radio.php');
    exit();
}

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
    // Fuentes Alternas
    if (isset($_GET['f'])) {
        $canalAlt = $_GET['f'];
        $channels = mysqli_query($conn, "SELECT * FROM fuentes
        INNER JOIN canales ON fuentes.canal = canales.canalId
        INNER JOIN categorias ON canales.canalCategoria = categorias.categoriaId
        INNER JOIN paises ON fuentes.pais = paises.paisId
        WHERE fuenteId = $canalAlt");
        $result = mysqli_fetch_assoc($channels);
        $canalId = $result['canal'];
        $canalImg = $result['canalImg'];
        $canalNombre = $result['canalNombre'];
        $titulo = "Ver " . $canalNombre . " En Vivo";
        $descripcion = "Ver " . $canalNombre . " completamente gratis y en alta definición por Fútbol Honduras 24.";
        $canalCategoria = $result['categoriaNombre'];
        $categoria = $result['categoriaId'];
        $canalUrl = $result['canalUrl'];
        $canalPais = $result['pais'];
        $canalTipo = $result['tipo'];
        $canalComentario = $result['comentario'];
        $canalFechaComentario = $result['fechaComentario'];
        $epg = $result['epgCanal'];
        // Verificar que "c" coincida en BD
        if ($canal !== $result['canal']) {
            $canal = $result['canal'];
        }
    }
}
// Verificar tipo
if (empty($canalTipo)) {
    $canalTipo = 'default';
}
// iframes
if (isset($_GET['title'])) {
    $canalNombre = $_GET['title'];
}
// NBA LP
elseif (isset($_GET['nbalp'])) {
    $canalNombre = " League Pass";
}
// DB
elseif (isset($_GET['id'])) {
    $partidoID = $_GET['id'];
    $partido = mysqli_query($conn, "SELECT p.id, p.local, p.visitante,
    e1.equipoId AS id_local, e1.equipoNombre AS equipo_local,
    e2.equipoId AS id_visitante, e2.equipoNombre AS equipo_visitante
    FROM partidos p
    JOIN equipos e1 ON p.local = e1.equipoId
    JOIN equipos e2 ON p.visitante = e2.equipoId
    WHERE p.id='$partidoID'");
    $ross = mysqli_fetch_assoc($partido);
    $canalNombre = $ross['equipo_local'] . " vs " . $ross['equipo_visitante'];
    $titulo = "Ver " . $canalNombre . " En Vivo";
    $descripcion = "Ver el partido " . $canalNombre . " completamente gratis y en alta definición por iRaffle TV.";
}
include('inc/usuario/validar.php');
?>
<div id="toast-container" class="position-fixed bottom-0 end-0 p-3">
</div>

<section class="container mb-5 pt-4 pb-2 py-mg-4">
    <div class="row gy-4">

        <!-- Content -->
        <div id="playerCol" class="col-lg-9">
            <div class="row">
                <div class="col-9">
                    <h2 class="h4"> Ver
                        <?= ucwords($canalNombre) ?> En Vivo
                    </h2>
                </div>
                <div class="col-3">
                    <!-- Toggle Size Player -->
                    <div class="d-flex justify-content-end">
                        <div id="mode-switch" class="form-check form-switch mode-switch pe-lg-1 ms-auto me-4">
                            <input type="checkbox" class="form-check-input" id="expandirBtn" data-bs-toggle="tooltip"
                                data-bs-placement="top" title="Cambiar modo teatro">
                            <label class="form-check-label d-none d-sm-block" for="expandirBtn">Normal</label>
                            <label class="form-check-label d-none d-sm-block" for="expandirBtn">Teatro</label>
                        </div>
                    </div>
                </div>
                <?php if (validarSuscripcion() !== true): ?>
                    <div class="alert alert-warning text-center" role="alert">
                        Elimina los anuncios de la página y accede a contenido excluisvo. <a href="?p=premium">Aquí!</a>
                    </div>
                <?php endif; ?>
                <?php
                if (isset($canalTipo) && $canalTipo == 4 || $canalTipo == 8) {
                    ?>
                    <div id="alerta-extension" class="alert alert-primary text-center" role="alert">Para visualizar el
                        contenido, debes instalar la extensión: <a
                            href="https://chrome.google.com/webstore/detail/videoplayer-mpdm3u8m3uepg/opmeopcambhfimffbomjgemehjkbbmji/reviews"
                            target="_blank">Reproductor MPD/M3U8/M3U/EPG.</a>
                    </div>
                <?php } ?>
                <?php
                if (validarSuscripcion() !== true && isset($canalTipo) && $canalTipo == 7 || validarSuscripcion() !== true && strpos($canalUrl, "vustreams") !== false) {
                    ?>
                    <div id="alerta-extension" class="alert alert-primary text-center" role="alert">
                        <span class="badge bg-danger ms-1 faa-tada animated">Aviso</span>
                        Este canal es <a href="?p=premium" target="_blank">exclusivo para miembros.</a> Por favor <a
                            href="?p=login" target="_blank">inicia sesión</a> si ya lo eres.
                    </div>
                <?php } ?>
            </div>
            <!-- Reproductor -->
            <div class="gallery mb-4 pb-2">
                <a id="playerFake" style="display: none"
                    href="https://www.highcpmrevenuegate.com/mkd1fhhe?key=81193c57b7f58377107604b71a3e49aa"
                    target="_blank">
                    <img class="img-fluid" src="assets/img/player_img.png" alt="">
                </a>
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
                        '13' => ["v1x.php", ['c', 'f']],
                        '12' => ["izzi.php", ['c', 'f']],
                        '11' => ["ckm.php", ['c', 'f']],
                        '10' => ["twitch.php", ['c', 'f']],
                        '9' => ["ck.php", ['c', 'f']],
                        '8' => ["pluto.php", ['c', 'f']],
                        '7' => ["sl2.php", ['c', 'f']],
                        '6' => ["bm.php", ['c', 'f']],
                        '5' => ["tdt.php", ['c', 'f']],
                        '4' => ["pc.php", ['c', 'f']],
                        '3' => ["yt.php", ['c', 'f']],
                        '2' => ["frame.php", ['c', 'f']],
                        '1' => ["hls.php", ['c', 'f']]
                    ];

                    // Obtener el tipo de configuración
                    if (isset($_GET['ifr']) || isset($_GET['evento'])) {
                        // NBA LP
                        if (isset($_GET["nbalp"])) {
                            $idFrame = $_GET["nbalp"];
                            $src = "//irtvhn.info/nba.php?id=" . $idFrame;
                            $src = "id='embed-player' class='embed-responsive-item' width='100%' height='100%' frameborder='0' scrolling='no' allowfullscreen allow-encrypted-media src='$src'";
                            echo "<iframe {$src}></iframe>";

                        } else {
                            $decodedIfr = base64_decode($_GET['ifr']);
                            $canalUrl = $decodedIfr;
                            // Validar la URL antes de mostrarla en el iframe
                            if (filter_var($decodedIfr, FILTER_VALIDATE_URL)) {
                                // Si la URL es válida, mostrarla en el iframe
                                $src = "id='embed-player' class='embed-responsive-item' width='100%' height='100%' frameborder='0' scrolling='no' allowfullscreen allow='encrypted-media' src='{$decodedIfr}'";
                                echo "<iframe {$src}></iframe>";
                            } else {
                                // Si la URL no es válida, mostrar un mensaje de error o redirigir a una página de error
                                $src = "id='embed-player' class='embed-responsive-item' width='100%' height='100%' frameborder='0' scrolling='no' allowfullscreen allow='encrypted-media' src='?p=404'";
                                echo "<iframe {$src}></iframe>";
                            }
                        }
                    } elseif (isset($_GET['r']) && isset($_GET['img'])) {
                        $config = $configurations['r'];
                        // Construir los parámetros para la URL del iframe
                        $params = implode("&", array_map(function ($param) {
                            return isset($_GET[$param]) ? "{$param}={$_GET[$param]}" : "";
                        }, $config[1]));
                        // Construir la URL del iframe con la configuración correspondiente
                        $src = "id='embed-player' class='embed-responsive-item' width='100%' height='100%' frameborder='0' scrolling='no' allowfullscreen allow='encrypted-media *; autoplay' src='inc/reproductor/{$config[0]}?{$params}'";
                        echo "<iframe {$src}></iframe>";
                    } elseif (isset($_GET['s'])) {
                        $config = $configurations['s'];
                        // Construir los parámetros para la URL del iframe
                        $params = implode("&", array_map(function ($param) {
                            return isset($_GET[$param]) ? "{$param}={$_GET[$param]}" : "";
                        }, $config[1]));
                        // Construir la URL del iframe con la configuración correspondiente
                        $src = "id='embed-player' class='embed-responsive-item' width='100%' height='100%' frameborder='0' scrolling='no' allowfullscreen allow='encrypted-media *; autoplay' src='inc/reproductor/{$config[0]}?{$params}'";
                        echo "<iframe {$src}></iframe>";
                    } else {
                        // Configurar los claro && Flow
                        if (strpos($canalUrl, "claro") || strpos($canalUrl, "cvatt")) {
                            $src = "id='embed-player' class='embed-responsive-item' width='100%' height='100%' frameborder='0' scrolling='no' allowfullscreen allow='encrypted-media' src='//clarovideo.futbolhonduras24.store?c=$canalAlt'";
                        }
                        // Configurar los IZZI
                        elseif (strpos($canalUrl, "izzigo")) {
                            $src = "id='embed-player' class='embed-responsive-item' width='100%' height='100%' frameborder='0' scrolling='no' allowfullscreen allow='encrypted-media' src='//izzigo.futbolhonduras24.store?c=$canalAlt'";
                        } elseif (isset($canalTipo) && isset($configurations[$canalTipo])) {
                            // Obtener el tipo de canal de la base de datos y verificar si existe en las configuraciones
                            $config = $configurations[$canalTipo];

                            // Construir los parámetros para la URL del iframe
                            $params = implode("&", array_map(function ($param) {
                                return isset($_GET[$param]) ? "{$param}={$_GET[$param]}" : "";
                            }, $config[1]));

                            // Construir la URL del iframe con la configuración correspondiente
                            $src = "id='embed-player' class='embed-responsive-item' width='100%' height='100%' frameborder='0' scrolling='no' allowfullscreen allow-encrypted-media src='inc/reproductor/{$config[0]}?{$params}'";
                        } else {
                            // Manejar el caso por defecto o mostrar un error si el tipo de canal no es válido
                            $src = "id='embed-player' class='embed-responsive-item' width='100%' height='100%' frameborder='0' scrolling='no' allowfullscreen allow-encrypted-media src='inc/reproductor/ck.php'";
                        }

                        // Imprimir el iframe
                        echo "<iframe {$src}></iframe>";
                    }
                    ?>

                </div>
            </div>
            <?php if (isset($_GET['c']) && $_GET['c'] == 800 || $_GET['c'] == 801 || $_GET['c'] == 79): ?>
                <p class="fs-sm">
                    <span class="badge bg-danger ms-1 faa-tada animated">Aviso</span>
                    Este canal es eventual y se activa algunos minutos antes del comienzo del evento.
                </p>
            <?php endif; ?>
            <?php if (strpos($canalUrl, "ESPDHD-8083") == true): ?>
                <p class="fs-sm">
                    <span class="badge bg-danger ms-1 faa-tada animated">Aviso</span>
                    Este canal es para miembros VIP.
                </p>
            <?php endif; ?>
            <hr class="mb-4">
            <div class="row">
                <div class="col-4">
                    <?php (isset($_GET['c']) ? include('inc/componentes/fuentes.php') : ''); ?>
                </div>
                <div class="col-4">
                    <?php include('inc/componentes/guia/watching.php'); ?>
                </div>
                <div style="text-align: end;" class="col-4">
                    <?php include('inc/componentes/app.php'); ?>
                    <!--script src="inc/ads/related-ad.php"></script>-->
                </div>
            </div>
        </div>

        <!-- Votos -->
        <div id="chatCol" class="col-lg-3 position-relative">
            <div class="sticky-top " style="top: 15px !important;">
                <?php
                // Banner
                if (isset($_GET['id'])):
                    include('inc/ads/banner.php');
                endif;
                $playlists = [
                    ['condition' => isset($canalTipo) && $canalTipo == 8, 'url' => "?p=tv&playlist=PlutoTV_tv_ES", 'title' => '¡Mira todos los canales de Pluto TV!'],
                    ['condition' => isset($canalUrl) && strpos($canalUrl, "RakutenTV") !== false, 'url' => "?p=tv&playlist=RakutenTV_tv", 'title' => '¡Mira todos los canales de Rakuten TV!'],
                    ['condition' => isset($canalUrl) && strpos($canalUrl, "ottera") !== false, 'url' => "?p=tv&playlist=CanelaTV_tv", 'title' => '¡Mira todos los canales de Canela TV!']
                ];
                foreach ($playlists as $playlist) {
                    if ($playlist['condition']) { ?>
                        <a style="text-decoration:none" href="<?= $playlist['url'] ?>">
                            <div class="card border-primary card-hover">
                                <div class="card-body text-center">
                                    <h5 class="card-title"><?= $playlist['title'] ?></h5>
                                </div>
                            </div>
                        </a>
                        <?php break;
                    }
                } ?>
                <br>
                <!-- Chat -->
                <div class="rounded-3">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a href="#chat" class="nav-link active" data-bs-toggle="tab" role="tab">
                                <i class="bx bx-message-detail opacity-70 me-2"></i>
                                Chat
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#tgpost" class="nav-link" data-bs-toggle="tab" role="tab">
                                <i class="bx bxl-telegram opacity-70 me-2"></i>
                                TG
                            </a>
                        </li>
                    </ul>

                    <!-- Tabs content -->
                    <div class="tab-content">
                        <div class="tab-pane fade" id="tgpost" role="tabpanel">
                            <?php include('inc/componentes/tgpost.php'); ?>
                        </div>
                        <div class="tab-pane fade show active" id="chat" role="tabpanel">
                            <iframe id="twitch-chat-embed" class="rounded-3" src height="560" width="100%"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="assets/js/playconfig3.js"></script>
    </div>
    </div>
</section>
<!-- Relacionados -->
<?php include('inc/componentes/relacionados.php'); ?>

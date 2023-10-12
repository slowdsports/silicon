<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
if (isset($_GET['c'])) {
    $canal = $_GET['c'];
    $channels = mysqli_query($conn, "SELECT * FROM canales
    INNER JOIN categorias ON canales.canalCategoria = categorias.categoriaId
    WHERE canalId = $canal");
    $result = mysqli_fetch_assoc($channels);
    $canalId = $result['canalId'];
    $canalImg = $result['canalImg'];
    $canalNombre = $result['canalNombre'];
    $canalCategoria = $result['categoriaNombre'];
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
        $canalUrl = $result['canalUrl'];
        $canalPais = $result['canalPais'];
        $canalTipo = $result['tipo'];
    }
}
// iframes
if (isset($_GET['title'])) {
    $canalNombre = $_GET['title'];
}
// No hay nombre
if ($canalNombre === null || $canalNombre == "") {
    $canalNombre = "";
}
?>
<section class="container mt-4 mb-5 pt-2 pb-lg-5">
    <div class="row gy-4">
        <div class="col-lg-8 col-md-7">
            <h1 class="display-5 pb-md-3">
                Ver <?= $canalNombre ?> En Vivo
            </h1>
            <!-- Reproductor -->
            <section class="container text-center pb-5 mt-n2 mt-md-0 mb-md-2 mb-lg-4">
                <!-- Fuentes alternativas -->
                <?php //include('inc/componentes/fuentes.php'); ?>
                <div class="embed-responsive embed-responsive-16by9" id="playerContainer">
                    <?php if (isset($_GET['r'])) { ?>
                        <iframe class="embed-responsive-item" width="100%" height="100%"
                            src="inc/reproductor/star.php?r=<?= $_GET['r'] ?>&key=<?= $_GET['key'] ?>&key2=<?= $_GET['key2'] ?>&img=<?= $_GET['img'] ?>"
                            frameborder="0" scrolling="no" allowfullscreen allow-encrypted-media></iframe>
                    <?php } elseif (isset($_GET['s'])) { ?>
                        <iframe class="embed-responsive-item" width="100%" height="100%"
                            src="inc/reproductor/hbo.php?s=<?= $_GET['s'] ?>&key=<?= $_GET['key'] ?>&key2=<?= $_GET['key2'] ?>"
                            frameborder="0" scrolling="no" allowfullscreen allow-encrypted-media></iframe>
                    <?php } elseif (isset($_GET['adult'])) { ?>
                        <iframe class="embed-responsive-item" width="100%" height="100%" src="inc/reproductor/adult.php"
                            frameborder="0" scrolling="no" allowfullscreen allow-encrypted-media></iframe>
                    <?php } elseif ($canalTipo == 11) { ?>
                        <iframe class="embed-responsive-item" width="100%" height="100%"
                            src="inc/reproductor/ckm.php?c=<?= $canal . (isset($canalAlt) ? "&f=" . $canalAlt : ""); ?>" frameborder="0" scrolling="no" allowfullscreen
                            allow-encrypted-media></iframe>
                    <?php } elseif ($canalTipo == 12) { ?>
                        <iframe class="embed-responsive-item" width="100%" height="100%"
                            src="inc/reproductor/mplus.php?c=<?= $canal . (isset($canalAlt) ? "&f=" . $canalAlt : ""); ?>" frameborder="0" scrolling="no" allowfullscreen
                            allow-encrypted-media></iframe>
                    <?php } elseif ($canalTipo == 6) { ?>
                        <iframe class="embed-responsive-item" width="100%" height="100%"
                            src="inc/reproductor/bm.php?c=<?= $canal . (isset($canalAlt) ? "&f=" . $canalAlt : ""); ?>" frameborder="0" scrolling="no" allowfullscreen
                            allow-encrypted-media></iframe>
                    <?php } elseif ($canalTipo == 1) { ?>
                        <iframe class="embed-responsive-item" width="100%" height="100%"
                            src="inc/reproductor/hls.php?c=<?= $canal . (isset($canalAlt) ? "&f=" . $canalAlt : ""); ?>" frameborder="0" scrolling="no" allowfullscreen
                            allow-encrypted-media></iframe>
                    <?php } elseif (isset($_GET['hls'])) { ?>
                        <iframe class="embed-responsive-item" width="100%" height="100%"
                            src="inc/reproductor/hls.php?c=<?= $_GET['c'] ?>" frameborder="0" scrolling="no" allowfullscreen
                            allow-encrypted-media></iframe>
                    <?php } elseif (isset($_GET['nba']) || isset($_GET['nfl']) || isset($_GET['mlb']) || isset($_GET['evento'])) { ?>
                        <iframe class="embed-responsive-item" allow="geolocation; microphone; camera; encrypted-media"
                            width="100%" height="100%" src="<?= base64_decode($_GET['ifr']) ?>" frameborder="0"
                            scrolling="no" allowfullscreen
                            allow="geolocation; microphone; camera; encrypted-media"></iframe>
                    <?php } elseif ($canalTipo == 2) { ?>
                        <iframe class="embed-responsive-item" width="100%" height="100%" src="<?= $canalUrl ?>"
                            frameborder="0" scrolling="no" allowfullscreen allow-encrypted-media></iframe>
                    <?php } else { ?>
                        <iframe class="embed-responsive-item" width="100%" height="100%"
                            src="inc/reproductor/ck.php?c=<?= $canal . (isset($canalAlt) ? "&f=" . $canalAlt : ""); ?>" frameborder="0"
                            scrolling="no" allowfullscreen allow-encrypted-media></iframe>
                    <?php } ?>
                </div>
                <br>
                <div class="alert d-flex alert-primary" role="alert">
                    <i class="bx bx-bell lead me-3"></i>
                    <div>
                        Algunos canales podrían no funcionar debido a que estuvimos algún tiempo fuera de servicio. Agredecemos su paciencia.
                    </div>
                </div>
            </section>
        </div>
        <div class="col-lg-4 col-md-5">
            <div class="ms-xl-5 ms-lg-4 ps-xxl-34">
                <h3 class="h6 mb-2">
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
                </h3>
                <!-- <div class="d-flex align-items-center flex-wrap text-muted mb-lg-5 mb-md-4 mb-3">
                    <div class="fs-xs border-end pe-3 me-3 mb-2">
                        <span class="badge bg-faded-primary text-primary fs-base">Startups</span>
                    </div>
                    <div class="fs-sm border-end pe-3 me-3 mb-2">10 hours ago</div>
                    <div class="d-flex mb-2">
                        <div class="d-flex align-items-center me-3">
                            <i class="bx bx-like fs-base me-1"></i>
                            <span class="fs-sm">18</span>
                        </div>
                        <div class="d-flex align-items-center me-3">
                            <i class="bx bx-comment fs-base me-1"></i>
                            <span class="fs-sm">4</span>
                        </div>
                        <div class="d-flex align-items-center">
                            <i class="bx bx-share-alt fs-base me-1"></i>
                            <span class="fs-sm">2</span>
                        </div>
                    </div>
                </div> -->
                <div class="rounded-3">
                    <iframe id="twitch-chat-embed" class="rounded-3"
                        src="https://www.twitch.tv/embed/iraffletv/chat?parent=127.0.0.1&parent=irtvhn.info&darkpopout"
                        height="600" width="100%">
                    </iframe>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Relacionados -->
<div class="row">
    <?php //include('inc/componentes/canales.php'); ?>
</div>
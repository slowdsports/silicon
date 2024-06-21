<?php
// Generar
$json_url = 'https://irtvhn.online/json/star.json';
// Obtener el contenido del JSON desde la URL
$json_content = file_get_contents($json_url);
// Verificar si la solicitud fue exitosa
if ($json_content !== false) {
    // Guardar el contenido en un archivo llamado "starbr.json"
    file_put_contents('datos.json', $json_content);
} else {
    echo 'Error al obtener el contenido del JSON, por favor comuníquelo al admin';
}
?>
<section id="repro" class="container mb-5 pt-4 pb-2 py-mg-4 hidden">
    <div class="row gy-4">
        <div id="playerCol" class="col-lg-9">
            <div class="row">
                <div class="col-9">
                    <h2 id="titulo-evento" class="h4">Nombre del evento</h2>
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
                <div id="alerta-extension" class="alert alert-primary text-center" role="alert">Para visualizar el contenido, debes instalar la extensión: <a href="https://chrome.google.com/webstore/detail/videoplayer-mpdm3u8m3uepg/opmeopcambhfimffbomjgemehjkbbmji/reviews" target="_blank">Reproductor MPD/M3U8/M3U/EPG.</a>
                </div>
                <!-- Reproductor -->
                <div class="gallery mb-4 pb-2">
                    <a id="playerFake" style="display: none"
                        href="https://www.highcpmrevenuegate.com/mkd1fhhe?key=81193c57b7f58377107604b71a3e49aa"
                        target="_blank">
                        <img class="img-fluid" src="assets/img/player_img.png" alt="">
                    </a>
                    <div class="embed-responsive embed-responsive-16by9" id="playerContainer">
                        <iframe allow="encrypted-media" allowfullscreen id='embed-player' class='embed-responsive-item' width='100%' height='100%'
                            frameborder='0' scrolling='no'></iframe>
                </div>
            </div>
        </div>
        <!-- Votos -->
        <div id="chatCol" class="col-lg-3 position-relative">
            <div class="sticky-top " style="top: 105px !important;">
                <!-- Chat -->
                <div class="rounded-3">
                    <iframe id="twitch-chat-embed" class="rounded-3" src height="560" width="100%"></iframe>
                </div>
            </div>
            <script src="assets/js/playconfig3.js"></script>
        </div>
    </div>
</section>
<section class="container mb-5 pt-4 pb-2 py-mg-4">
    <!-- Page title + Filters -->
    <div class="d-lg-flex align-items-center justify-content-between py-4 mt-lg-2">
        <h1 class="me-3">Star+</h1>
        <div class="d-md-flex mb-3">
            <div class="position-relative" style="min-width: 300px;">
                <input id="filtroInput" type="text" class="form-control pe-5" placeholder="Buscar evento">
                <i class="bx bx-search text-nav fs-lg position-absolute top-50 end-0 translate-middle-y me-3"></i>
            </div>
        </div>
    </div>
    <!-- Events grid -->
    <div id="eventos" class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 gx-3 gx-md-4 mt-n2 mt-sm-0">
        <script src="inc/eventos/starr.js"></script>
    </div>
</section>

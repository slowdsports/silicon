<?php
// GET Param
$getParam = $_GET['playlist'];
// URL del archivo M3U
if (strpos($getParam, "PlutoTV") !== false) {
    $m3u_url = "https://raw.githubusercontent.com/HelmerLuzo/PlutoTV_HL/main/tv/m3u/" . $getParam . ".m3u";
    $company = "Pluto";
} elseif (strpos($getParam, "RakutenTV") !== false) {
    $m3u_url = "https://raw.githubusercontent.com/HelmerLuzo/RakutenTV_HL/main/tv/m3u/" . $getParam . ".m3u";
    $company = "Rakuten";
} elseif (strpos($getParam, "CanelaTV") !== false) {
    $m3u_url = "https://raw.githubusercontent.com/HelmerLuzo/CanelaTV_HL/main/tv/m3u/" . $getParam . ".m3u";
    $company = "Canela";
} elseif (strpos($getParam, "RunTimeTV") !== false) {
    $m3u_url = "https://raw.githubusercontent.com/HelmerLuzo/RuntimeTV_HL/main/tv/m3u/" . $getParam . ".m3u";
    $company = "Runtime";
}

// Descargar el contenido del archivo M3U
$m3u_content = file_get_contents($m3u_url);

// Dividir el contenido en líneas
$lines = explode("\n", $m3u_content);
?>
<section id="forPlay" class="container mb-5 pt-4 pb-2 py-mg-4">
    <div class="row gy-4">
        <!-- Content -->
        <div id="playerCol" class="col-lg-9">
            <div class="row">
                <div class="col-lg-9">
                    <h2 id="canalTitulo" class="h4"></h2>
                </div>
                <div class="col-3">
                    <!-- Toggle Size Player -->
                    <div class="d-flex justify-content-end">
                        <div id="mode-switch" class="form-check form-switch mode-switch pe-lg-1 ms-auto me-4">
                            <input type="checkbox" class="form-check-input" id="expandirBtn" data-bs-toggle="tooltip" data-bs-placement="top" title="Cambiar modo teatro">
                            <label class="form-check-label d-none d-sm-block" for="expandirBtn">Normal</label>
                            <label class="form-check-label d-none d-sm-block" for="expandirBtn">Teatro</label>
                        </div>
                    </div>
                </div>
            </div>
            <?php if (strpos($getParam, "PlutoTV") !== false) { ?>
            <div id="alerta-extension" class="alert alert-primary text-center" role="alert">Para visualizar el contenido, debes instalar la extensión: <a href="https://chrome.google.com/webstore/detail/videoplayer-mpdm3u8m3uepg/opmeopcambhfimffbomjgemehjkbbmji/reviews" target="_blank">Reproductor MPD/M3U8/M3U/EPG.</a>
            </div>
            <?php } ?>
            <div class="embed-responsive embed-responsive-16by9" id="playerContainer">
                <iframe id='embed-player' class='embed-responsive-item' width='100%' height='100%' frameborder='0' scrolling='no' allowfullscreen allow-encrypted-media src></iframe>
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
        </div>
    </div>
    <script src="assets/js/playconfig3.js"></script>
    </section>
    <section class="container text-center pt-5 mt-2 mt-md-4 mt-lg-5">
    <h2 class="h1 d-md-inline-block position-relative mb-md-5 mb-sm-4 text-sm-start text-center">
        Canales de <?=$company?> TV
        <!-- Arrow shape -->
        <svg class="d-md-block d-none position-absolute top-0 ms-4 ps-1" style="left: 100%;" xmlns="http://www.w3.org/2000/svg" width="65" height="68" fill="#6366f1">
            <path d="M53.9527 51.0012c8.396-10.5668 2.0302-26.0134-11.7481-26.7511-.6899-.0646-1.4612.0015-2.1258.0431.1243 9.0462-4.1714 18.8896-11.5618 21.3814-6.6695 2.2133-10.3337-4.2224-7.5813-9.676 3.2966-6.4755 9.103-11.8504 16.1678-13.8189-.5654-5.6953-3.3436-10.7672-9.485-12.48517C17.2678 6.8204 6.49364 16.3681 4.98841 26.127c-.09276 1.0297-1.68569.9497-1.59293-.0801C3.98732 12.9139 19.7395 2.55212 31.9628 8.5787c4.7253 2.3813 7.2649 7.3963 7.9368 13.067 7.4237-.9311 14.5154 3.3683 18.3422 9.5422 4.3988 7.1623 2.3584 15.1401-2.6322 21.1108-.7826.9653-2.3331-.3572-1.6569-1.2975zM26.7754 32.1845c-1.9411 2.2411-4.076 5.0872-4.3542 8.1764-.3036 2.9829 3.7601 3.0525 5.4905 2.7645 2.1568-.3863 3.7221-2.3164 4.8863-4.0419 2.6228-3.6308 4.3657-9.0752 4.4844-14.2563-4.0808 1.279-7.6514 4.2327-10.507 7.3573zm24.6311 25.592c-.7061-2.9738-1.2243-6.1031-1.1591-9.143.0423-1.242 1.767-1.0805 1.8313.1372.1284 2.435.815 4.8532 1.4764 7.1651l4.1619-1.4098c1.0153-.4586 2.4373-1.5714 3.6544-1.1804.6087.1954.7347.7264.6475 1.3068-.2302 1.3976-2.4683 1.9147-3.5901 2.398-1.8429.7619-3.6293 1.2865-5.5477 1.7298-.6391.1476-1.3233-.3665-1.4746-1.0037z">
            </path>
        </svg>
    </h2>
    <div id="canales" class="row">
        <!-- Filtro de Canales -->
        <form class="input-group">
            <input type="text" placeholder="Buscar un canal..." class="form-control form-control-lg rounded-3">
            <!-- <a class="btn btn-icon btn-lg btn-primary rounded-3 ms-3">
                <i class="bx bx-search"></i> </a> -->
            <!-- Dropdown -->
            <button type="button" class="btn btn-lg btn-primary rounded-3 ms-3 " data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <ion-icon name="funnel-outline"></ion-icon>
            </button>
            <div class="dropdown-menu my-1">
                <a class="dropdown-item" href="#" data-category="all">Todo</a>
                    <div class="dropdown-divider"></div>
                    <?php
                    $ccf = mysqli_query($conn, "SELECT categoriaId, categoriaNombre FROM categorias");
                    while ($rrf = mysqli_fetch_array($ccf)):
                    $catId = $rrf['categoriaId']; $catNombre = $rrf['categoriaNombre'];
                    $ccfn = mysqli_query($conn, "SELECT canalId, canalCategoria FROM canales WHERE canalCategoria = $catId");
                    $ttc = mysqli_num_rows($ccfn);
                    if ($ttc > 0):
                    ?>
                <a class="dropdown-item" href="#" data-category="<?=$catId?>">
                    <?=$catNombre?>
                </a>
                <?php endif; endwhile; ?>
            </div>
        </form>
        <?php
        if (strpos($getParam, "PlutoTV") !== false) { ?>
        <!-- Elementos seleccionables por País -->
        <!-- Multiple slides responsive slider with external Prev / Next buttons and bullets outside -->
        <div class="position-relative px-xl-5">
        
          <!-- Slider prev/next buttons -->
          <button type="button" id="prev-news" class="btn btn-prev btn-icon btn-sm position-absolute top-50 start-0 translate-middle-y d-none d-xl-inline-flex" aria-label="Previous">
            <i class="bx bx-chevron-left"></i>
          </button>
          <button type="button" id="next-news" class="btn btn-next btn-icon btn-sm position-absolute top-50 end-0 translate-middle-y d-none d-xl-inline-flex" aria-label="Next">
            <i class="bx bx-chevron-right"></i>
          </button>
        
          <!-- Slider -->
          <div class="px-xl-2">
            <div class="swiper mx-n2" data-swiper-options='{
              "slidesPerView": 1,
              "loop": true,
              "pagination": {
                "el": ".swiper-pagination",
                "clickable": true
              },
              "navigation": {
                "prevEl": "#prev-news",
                "nextEl": "#next-news"
              },
              "breakpoints": {
                "200": {
                  "slidesPerView": 2
                },
                "300": {
                  "slidesPerView": 4
                },
                "400": {
                  "slidesPerView": 5
                },
                "500": {
                  "slidesPerView": 6
                },
                "600": {
                  "slidesPerView": 8
                },
                "800": {
                  "slidesPerView": 10
                },
                "1000": {
                  "slidesPerView": 12
                }
              }
            }'>
              <div class="swiper-wrapper">
        
                <!-- Item -->
                <div class="swiper-slide h-auto pb-3">
                    <a href="?p=tv&playlist=PlutoTV_tv_AR">
                        <div class="card border-primary card-hover" style="max-width: 20rem;">
                          <div class="card-body">
                            <h5 class="card-title">
                                <img width="25px" src="assets/img/equipos/sf/4819.png"></img>
                            </h5>
                          </div>
                        </div>
                    </a>
                </div>
                <!-- Item -->
                <div class="swiper-slide h-auto pb-3">
                    <a href="?p=tv&playlist=PlutoTV_tv_ES">
                        <div class="card border-primary card-hover" style="max-width: 20rem;">
                          <div class="card-body">
                            <h5 class="card-title">
                                <img width="25px" src="assets/img/equipos/sf/4698.png"></img>
                            </h5>
                          </div>
                        </div>
                    </a>
                </div>
                <!-- Item -->
                <div class="swiper-slide h-auto pb-3">
                    <a href="?p=tv&playlist=PlutoTV_tv_BR">
                        <div class="card border-primary card-hover" style="max-width: 20rem;">
                          <div class="card-body">
                            <h5 class="card-title">
                                <img width="25px" src="assets/img/equipos/sf/4748.png"></img>
                            </h5>
                          </div>
                        </div>
                    </a>
                </div>
                <!-- Item -->
                <div class="swiper-slide h-auto pb-3">
                    <a href="?p=tv&playlist=PlutoTV_tv_CL">
                        <div class="card border-primary card-hover" style="max-width: 20rem;">
                          <div class="card-body">
                            <h5 class="card-title">
                                <img width="25px" src="assets/img/equipos/sf/4754.png"></img>
                            </h5>
                          </div>
                        </div>
                    </a>
                </div>
                <!-- Item -->
                <div class="swiper-slide h-auto pb-3">
                    <a href="?p=tv&playlist=PlutoTV_tv_MX">
                        <div class="card border-primary card-hover" style="max-width: 20rem;">
                          <div class="card-body">
                            <h5 class="card-title">
                                <img width="25px" src="assets/img/equipos/sf/4781.png"></img>
                            </h5>
                          </div>
                        </div>
                    </a>
                </div>
                <!-- Item -->
                <div class="swiper-slide h-auto pb-3">
                    <a href="?p=tv&playlist=PlutoTV_tv_US">
                        <div class="card border-primary card-hover" style="max-width: 20rem;">
                          <div class="card-body">
                            <h5 class="card-title">
                                <img width="25px" src="assets/img/equipos/sf/4724.png"></img>
                            </h5>
                          </div>
                        </div>
                    </a>
                </div>
                <!-- Item -->
                <div class="swiper-slide h-auto pb-3">
                    <a href="?p=tv&playlist=PlutoTV_tv_CA">
                        <div class="card border-primary card-hover" style="max-width: 20rem;">
                          <div class="card-body">
                            <h5 class="card-title">
                                <img width="25px" src="assets/img/equipos/sf/4752.png"></img>
                            </h5>
                          </div>
                        </div>
                    </a>
                </div>
                <!-- Item -->
                <div class="swiper-slide h-auto pb-3">
                    <a href="?p=tv&playlist=PlutoTV_tv_GB">
                        <div class="card border-primary card-hover" style="max-width: 20rem;">
                          <div class="card-body">
                            <h5 class="card-title">
                                <img width="25px" src="assets/img/equipos/sf/4713.png"></img>
                            </h5>
                          </div>
                        </div>
                    </a>
                </div>
                <!-- Item -->
                <div class="swiper-slide h-auto pb-3">
                    <a href="?p=tv&playlist=PlutoTV_tv_DE">
                        <div class="card border-primary card-hover" style="max-width: 20rem;">
                          <div class="card-body">
                            <h5 class="card-title">
                                <img width="25px" src="assets/img/equipos/sf/4711.png"></img>
                            </h5>
                          </div>
                        </div>
                    </a>
                </div>
                <!-- Item -->
                <div class="swiper-slide h-auto pb-3">
                    <a href="?p=tv&playlist=PlutoTV_tv_FR">
                        <div class="card border-primary card-hover" style="max-width: 20rem;">
                          <div class="card-body">
                            <h5 class="card-title">
                                <img width="25px" src="assets/img/equipos/sf/4481.png"></img>
                            </h5>
                          </div>
                        </div>
                    </a>
                </div>
                <!-- Item -->
                <div class="swiper-slide h-auto pb-3">
                    <a href="?p=tv&playlist=PlutoTV_tv_IT">
                        <div class="card border-primary card-hover" style="max-width: 20rem;">
                          <div class="card-body">
                            <h5 class="card-title">
                                <img width="25px" src="assets/img/equipos/sf/4707.png"></img>
                            </h5>
                          </div>
                        </div>
                    </a>
                </div>
              </div>
        
              <!-- Pagination (bullets) -->
              <div class="swiper-pagination position-relative bottom-0 mt-4 mb-lg-2"></div>
            </div>
          </div>
        </div>
        <?php } ?>
        <?php
        foreach ($lines as $key => $line) {
        $line = trim($line);
        if (empty($line)) continue;
        if (strpos($line, '#EXTINF:') === 0) {
        preg_match('/tvg-id="([^"]+)" tvg-name="([^"]+)" tvg-logo="([^"]+)" group-title="([^"]+)"/', $line, $matches);
        if (count($matches) === 5) {
            $canalId = $matches[1];
            $canalNombre = $matches[2];
            $canalImg = $matches[3];
            $canalCategoria = $matches[4];
            $categoria = strtolower(str_replace(' ', '-', $canalCategoria));
            $pais = 'argentina';
            $canalUrl = isset($lines[$key + 1]) ? trim($lines[$key + 1]) : '';?>
        <div class="canal mycard col-6 col-md-4 col-lg-3 col-xl-2" data-category="<?= $categoria ?>">
            <a href="#canalTitulo" data-name="<?= base64_encode($canalNombre) ?>" data-id="<?= base64_encode($canalUrl) ?>">
                <div class="card border-primary shadow-sm card-hover card-hover-gradient" aria-hidden="true">
                    <div class="position-relative placeholder-wave">
                        <div class="card-header">
                            <img class="card-img-canal placeholder-wave" src="https://i.ibb.co/w0qg9JF/trans.png" alt="Card image" style="background-image: url('<?= $canalImg ?>'); background-size: contain; background-repeat: no-repeat;">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title placeholder-glow">
                                <?= $canalNombre ?>
                            </h5>
                            <div class="card-footer fs-sm text-muted placeholder-glow">
                            <i class="flag <?= $pais ?>"></i>
                                <?= $canalCategoria ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        <?php }
        }    
    }
    ?>
    </div>
</div>
</section>
<script>
    document.addEventListener('DOMContentLoaded', function() {
    // Seleccionamos todos los enlaces de los canales
    var canalLinks = document.querySelectorAll('.canal a');

    // Seleccionamos el iframe y lo ocultamos inicialmente
    var embedPlayer = document.getElementById('embed-player');
    var forPlay = document.getElementById('forPlay');
    var titulo = document.getElementById('canalTitulo');
    forPlay.style.display = 'none';

    // Añadimos un event listener a cada enlace de canal
    canalLinks.forEach(function(link) {
        link.addEventListener('click', function(event) {
            //event.preventDefault();
            var videoUrl = this.getAttribute('data-id');
            var canalNombre = this.getAttribute('data-name');
            embedPlayer.src = "inc/reproductor/pluto.php?hls=" + videoUrl;
            // Mostramos el iframe
            forPlay.style.display = 'block';
            titulo.innerHTML = atob(canalNombre);
            
        });
    });
});
</script>

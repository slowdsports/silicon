<?php
// Consumir el JSON
$jsonData = file_get_contents('inc/componentes/guia/json/partidos.json');
$partidos = json_decode($jsonData, true);

// Obtener y tratar fecha actual
date_default_timezone_set('Europe/Madrid');
$date = date('Y/m/d H:i:s');
$mm_0 = substr($date, 5, 2);
$dd_0 = substr($date, 8, 2);
?>
<!-- Page content -->
<section class="position-relative px-xl-5">
    <!-- Slider prev/next buttons -->
    <button type="button" id="prev-news"
        class="btn btn-prev btn-icon btn-sm position-absolute top-50 start-0 translate-middle-y d-none d-xl-inline-flex"
        aria-label="Anterior">
        <i class="bx bx-chevron-left"></i>
    </button>
    <button type="button" id="next-news"
        class="btn btn-next btn-icon btn-sm position-absolute top-50 end-0 translate-middle-y d-none d-xl-inline-flex"
        aria-label="Siguiente">
        <i class="bx bx-chevron-right"></i>
    </button>

    <!-- Slider -->
    <div class="swiper swiper-nav-onhover mx-n2" data-swiper-options='{
        "slidesPerView": 1,
        "spaceBetween": 8,
        "pagination": {
            "el": ".swiper-pagination",
            "clickable": true
        },
        "navigation": {
            "prevEl": "#prev-news",
            "nextEl": "#next-news"
        },
        "breakpoints": {
            "0": {
                "slidesPerView": 1
            },
            "560": {
                "slidesPerView": 2
            },
            "992": {
                "slidesPerView": 3
            }
        }
    }'>
        <div class="swiper-wrapper">
            <?php
            // Iterar sobre los partidos del JSON
            foreach ($partidos as $result):
                // Equipos y datos del partido
                $index = $result['id'];
                $local = $result['equipo_local'];
                $local_id = $result['id_local'];
                $visitante = $result['equipo_visitante'];
                $visitante_id = $result['id_visitante'];
                $liga_id = $result['id_liga'];
                $liga = $result['liga'];
                $fecha = $result['fecha_hora'];
                $hora = substr($fecha, 11, 5);
                $tipo = $result['tipo'];
                $starp = $result['starp'];
                $vix = $result['vix'];
                // Obtener y tratar fecha del partido
                $mm_1 = substr($fecha, 5, 2);
                $dd_1 = substr($fecha, 8, 2);
                $hh_1 = substr($fecha, 11, 2);
                $m_1 = substr($fecha, 14, 2);
                // Verificar si el partido es de hoy
                if ($mm_0 === $mm_1 && $dd_0 === $dd_1):
                    ?>
                    <!-- Item -->
                    <div class="swiper-slide h-auto py-3" data-id="<?= $index ?>">
                        <article class="card border-primary card-hover p-md-3 p-2 shadow-sm card-hover-primary h-100 mx-2">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <a href="?p=eventos&tipo=<?= $tipo ?>"
                                    class="badge fs-sm text-nav bg-secondary text-decoration-none position-relative zindex-2">
                                    <?= ucfirst($tipo) ?>
                                </a>
                                <span class="fs-sm text-muted">
                                    <p class="counter cntdwn-<?= $index ?>"></p>
                                </span>
                            </div>
                            <a href="?p=eventos&tipo=<?= $tipo ?>&liga=<?= $liga_id ?>&juego=<?= $index ?>">
                                <div class="mini-league">
                                    <img class="league-img" width="50px"
                                        src="assets/img/ligas/sf/<?= $liga_id ?>.png" alt="">
                                    <h5><?= $liga ?></h5>
                                </div>
                                <div class="main-event">
                                    <div class="match">
                                        <div class="team">
                                            <img src="assets/img/equipos/sf/<?= $local_id ?>.png" class="image" alt="image">
                                            <h4><?= ucfirst($local) ?></h4>
                                        </div>
                                        <h5 class="vs">vs</h5>
                                        <div class="team">
                                            <img src="assets/img/equipos/sf/<?= $visitante_id ?>.png" class="image" alt="image">
                                            <h4><?= ucfirst($visitante) ?></h4>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </article>
                    </div>
                <?php include('inc/componentes/timer.php'); endif; endforeach;?>
        </div>
        <!-- Pagination (bullets) -->
        <div class="swiper-pagination position-relative pt-2 pt-sm-3 mt-4"></div>
    </div>
</section>
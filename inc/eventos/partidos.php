<?php
$getLiga = $_GET['liga'];
$ligas = mysqli_query($conn, "SELECT * FROM ligas
WHERE ligaId = '$getLiga'");
$result = mysqli_fetch_array($ligas);
$ligaNombre = $result['ligaNombre'];
?>
<section class="container pb-2 pb-md-4 pb-lg-5 mb-3">
    <h1 class="pb-4">Partidos de
        <?= $ligaNombre ?> En Vivo
    </h1>
    <div class="container">
        <div class="row">
            <?php
            $partidos = mysqli_query($conn, "SELECT p.id, p.local, p.visitante, p.liga, p.fecha_hora, p.tipo, p.starp, p.vix, 
            e1.equipoId AS id_local, e1.equipoNombre AS equipo_local,
            e2.equipoId AS id_visitante, e2.equipoNombre AS equipo_visitante,
            e3.ligaNombre AS partido_liga,
            c1.canalId AS id_canal1, c1.canalNombre AS nombre_canal1,
            p1.paisNombre AS pais_canal1,
            c2.canalId AS id_canal2, c2.canalNombre AS nombre_canal2,
            p2.paisNombre AS pais_canal2,
            c3.canalId AS id_canal3, c3.canalNombre AS nombre_canal3,
            p3.paisNombre AS pais_canal3,
            c4.canalId AS id_canal4, c4.canalNombre AS nombre_canal4,
            p4.paisNombre AS pais_canal4,
            c5.canalId AS id_canal5, c5.canalNombre AS nombre_canal5,
            p5.paisNombre AS pais_canal5,
            c6.canalId AS id_canal6, c6.canalNombre AS nombre_canal6,
            p6.paisNombre AS pais_canal6,
            c7.canalId AS id_canal7, c7.canalNombre AS nombre_canal7,
            p7.paisNombre AS pais_canal7,
            c8.canalId AS id_canal8, c8.canalNombre AS nombre_canal8,
            p8.paisNombre AS pais_canal8,
            c9.canalId AS id_canal9, c9.canalNombre AS nombre_canal9,
            p9.paisNombre AS pais_canal9,
            c10.canalId AS id_canal10, c10.canalNombre AS nombre_canal10,
            p10.paisNombre AS pais_canal10
            FROM partidos p
            JOIN equipos e1 ON p.local = e1.equipoId
            JOIN equipos e2 ON p.visitante = e2.equipoId
            JOIN ligas e3 ON p.liga = e3.ligaId
            LEFT JOIN canales c1 ON p.canal1 = c1.canalId
            LEFT JOIN paises p1 ON c1.canalPais = p1.paisId
            LEFT JOIN canales c2 ON p.canal2 = c2.canalId
            LEFT JOIN paises p2 ON c1.canalPais = p2.paisId
            LEFT JOIN canales c3 ON p.canal3 = c3.canalId
            LEFT JOIN paises p3 ON c1.canalPais = p3.paisId
            LEFT JOIN canales c4 ON p.canal4 = c4.canalId
            LEFT JOIN paises p4 ON c1.canalPais = p4.paisId
            LEFT JOIN canales c5 ON p.canal5 = c5.canalId
            LEFT JOIN paises p5 ON c1.canalPais = p5.paisId
            LEFT JOIN canales c6 ON p.canal6 = c6.canalId
            LEFT JOIN paises p6 ON c1.canalPais = p6.paisId
            LEFT JOIN canales c7 ON p.canal7 = c7.canalId
            LEFT JOIN paises p7 ON c1.canalPais = p7.paisId
            LEFT JOIN canales c8 ON p.canal8 = c8.canalId
            LEFT JOIN paises p8 ON c1.canalPais = p8.paisId
            LEFT JOIN canales c9 ON p.canal9 = c9.canalId
            LEFT JOIN paises p9 ON c1.canalPais = p9.paisId
            LEFT JOIN canales c10 ON p.canal10 = c10.canalId
            LEFT JOIN paises p10 ON c1.canalPais = p10.paisId
            WHERE liga='$getLiga'
            ORDER BY
            fecha_hora asc
            ");
            while ($result = mysqli_fetch_array($partidos)) {
                // Teams
                $local = $result['equipo_local'];
                $local_id = $result['id_local'];
                $visitante = $result['equipo_visitante'];
                $visitante_id = $result['id_visitante'];
                $index = $result['id'];
                $tipo = $result['tipo'];
                $starp = $result['starp'];
                $vix = $result['vix'];
                $i++;
                $numero = $i;
                // Channels Image
                $ciSearch = $result['id_canal1'];
                if ($ciSearch == null || $ciSearch == "") {
                    $ciSearch = $result['id_canal2'];
                    if ($ciSearch == null || $ciSearch == "") {
                        $ciSearch = $result['id_canal3'];
                    }
                    if ($ciSearch == null || $ciSearch == "") {
                        $ciSearch = $result['id_canal4'];
                    }
                    if ($ciSearch == null || $ciSearch == "") {
                        $ciSearch = $result['id_canal5'];
                    }
                    if ($ciSearch == null || $ciSearch == "") {
                        $ciSearch = $result['id_canal6'];
                    }
                }
                $ciQuery = mysqli_query($conn, "SELECT * FROM canales
                WHERE canalId = '$ciSearch'");
                $ciResult = mysqli_fetch_array($ciQuery);
                $canalImg = $ciResult['canalImg'];
                // Star o Vix
                if ($canalImg === null) {
                    if ($result['starp'] == 1) {
                        $canalImg = "starplus";
                    } elseif ($result['vix'] == 1) {
                        $canalImg = "vix";
                    }
                }
                // Default
                if ($canalImg === null) {
                    $canalImg = "152x152";
                }
                include('inc/componentes/cntdwn.php');
                ?>
                <!-- Elemento -->
                <div class="col-12 mycard">
                    <a data-bs-toggle="collapse" href="#juego<?= $index ?>" role="button" aria-expanded="<?= $aria ?>"
                        aria-controls="juego<?= $index ?>">
                        <div class="card product-card">
                            <div class="main-event">
                                <div class="league">
                                    <img src="https://api.sofascore.app/api/v1/unique-tournament/<?= $getLiga ?>/image/dark"
                                        alt="League" />
                                    <!-- <p class="<?= $index ?>"><?= ucfirst($dia) ?></p> -->
                                    <p class="fs-sm text-body mb-0 cntdwn-<?= $index ?>"></p>
                                </div>
                                <div class="match">
                                    <div class="team">
                                        <img width="60px" src="https://api.sofascore.app/api/v1/team/<?= $local_id ?>/image"
                                            alt="" />
                                        <h4>
                                            <?= ucfirst($local) ?>
                                        </h4>
                                    </div>
                                    <div <?= $isEventoHidden ?> class="vs">
                                        <h6>vs</h6>
                                    </div>
                                    <div <?= $isEventoHidden ?> class="team">
                                        <img width="60px"
                                            src="https://api.sofascore.app/api/v1/team/<?= $visitante_id ?>/image" alt="" />
                                        <h4>
                                            <?= ucfirst($visitante) ?>
                                        </h4>
                                    </div>
                                </div>
                                <div class="channel">
                                    <img src="assets/img/canales/<?= $canalImg ?>.png" alt="" />
                                </div>
                            </div>
                        </div>
                    </a>
                    <div class="collapse <?= $collapse ?>" id="juego<?= $index ?>">
                        <div class="card card-body">
                            <div class="list-group text-center">
                                <?php
                                // Canal 1
                                if ($result['id_canal1'] === null || $result['id_canal1'] === "") {
                                    // No mostramos nada
                                } else {
                                    ?>

                                    <a class="justify-content-center list-group-item list-group-item-action"
                                        href="?p=tv&<?= $tipo ?>&id=<?= $index ?>&c=<?= $result['id_canal1'] ?>">
                                        <i class="flag <?= $result['pais_canal1'] ?>"></i>
                                        <?= $result['nombre_canal1'] ?>
                                    </a>

                                <?php } ?>
                                <?php
                                // Canal 2
                                if ($result['id_canal2'] === null || $result['id_canal2'] === "") {
                                    // No mostramos nada
                                } else {
                                    ?>

                                    <a class="justify-content-center list-group-item list-group-item-action"
                                        href="?p=tv&<?= $tipo ?>&id=<?= $index ?>&c=<?= $result['id_canal2'] ?>">
                                        <i class="flag <?= $result['pais_canal2'] ?>"></i>
                                        <?= $result['nombre_canal2'] ?>
                                    </a>

                                <?php } ?>
                                <?php
                                // Canal 3
                                if ($result['id_canal3'] === null || $result['id_canal3'] === "") {
                                    // No mostramos nada
                                } else {
                                    ?>

                                    <a class="justify-content-center list-group-item list-group-item-action"
                                        href="?p=tv&<?= $tipo ?>&id=<?= $index ?>&c=<?= $result['id_canal3'] ?>">
                                        <i class="flag <?= $result['pais_canal3'] ?>"></i>
                                        <?= $result['nombre_canal3'] ?>
                                    </a>

                                <?php } ?>
                                <?php
                                // Canal 4
                                if ($result['id_canal4'] === null || $result['id_canal4'] === "") {
                                    // No mostramos nada
                                } else {
                                    ?>

                                    <a class="justify-content-center list-group-item list-group-item-action"
                                        href="?p=tv&<?= $tipo ?>&id=<?= $index ?>&c=<?= $result['id_canal4'] ?>">
                                        <i class="flag <?= $result['pais_canal4'] ?>"></i>
                                        <?= $result['nombre_canal4'] ?>
                                    </a>

                                <?php } ?>
                                <?php
                                // Canal 5
                                if ($result['id_canal5'] === null || $result['id_canal5'] === "") {
                                    // No mostramos nada
                                } else {
                                    ?>

                                    <a class="justify-content-center list-group-item list-group-item-action"
                                        href="?p=tv&<?= $tipo ?>&id=<?= $index ?>&c=<?= $result['id_canal5'] ?>">
                                        <i class="flag <?= $result['pais_canal5'] ?>"></i>
                                        <?= $result['nombre_canal5'] ?>
                                    </a>

                                <?php } ?>
                                <?php
                                // Canal 6
                                if ($result['id_canal6'] === null || $result['id_canal6'] === "") {
                                    // No mostramos nada
                                } else {
                                    ?>

                                    <a class="justify-content-center list-group-item list-group-item-action"
                                        href="?p=tv&<?= $tipo ?>&id=<?= $index ?>&c=<?= $result['id_canal6'] ?>">
                                        <i class="flag <?= $result['pais_canal6'] ?>"></i>
                                        <?= $result['nombre_canal6'] ?>
                                    </a>

                                <?php } ?>
                                <?php
                                // Canal 7
                                if ($result['id_canal7'] === null || $result['id_canal7'] === "") {
                                    // No mostramos nada
                                } else {
                                    ?>

                                    <a class="justify-content-center list-group-item list-group-item-action"
                                        href="?p=tv&<?= $tipo ?>&id=<?= $index ?>&c=<?= $result['id_canal7'] ?>">
                                        <i class="flag <?= $result['pais_canal7'] ?>"></i>
                                        <?= $result['nombre_canal7'] ?>
                                    </a>

                                <?php } ?>
                                <?php
                                // Canal 8
                                if ($result['id_canal8'] === null || $result['id_canal8'] === "") {
                                    // No mostramos nada
                                } else {
                                    ?>

                                    <a class="justify-content-center list-group-item list-group-item-action"
                                        href="?p=tv&<?= $tipo ?>&id=<?= $index ?>&c=<?= $result['id_canal8'] ?>">
                                        <i class="flag <?= $result['pais_canal8'] ?>"></i>
                                        <?= $result['nombre_canal8'] ?>
                                    </a>

                                <?php } ?>
                                <?php
                                // Canal 9
                                if ($result['id_canal9'] === null || $result['id_canal9'] === "") {
                                    // No mostramos nada
                                } else {
                                    ?>

                                    <a class="justify-content-center list-group-item list-group-item-action"
                                        href="?p=tv&<?= $tipo ?>&id=<?= $index ?>&c=<?= $result['id_canal9'] ?>">
                                        <i class="flag <?= $result['pais_canal9'] ?>"></i>
                                        <?= $result['nombre_canal9'] ?>
                                    </a>

                                <?php } ?>
                                <?php
                                // Canal 10
                                if ($result['id_canal10'] === null || $result['id_canal10'] === "") {
                                    // No mostramos nada
                                } else {
                                    ?>

                                    <a class="justify-content-center list-group-item list-group-item-action"
                                        href="?p=tv&<?= $tipo ?>&id=<?= $index ?>&c=<?= $result['id_canal10'] ?>">
                                        <i class="flag <?= $result['pais_canal10'] ?>"></i>
                                        <?= $result['nombre_canal10'] ?>
                                    </a>

                                <?php } ?>

                                <?php
                                // Star
                                if ($starp == null || $starp == 0) {
                                    // No mostramos nada
                                } else {
                                    ?>

                                    <a class="justify-content-center list-group-item list-group-item-action" href="?p=star">
                                        <i class="flag ar"></i>
                                        Star +
                                    </a>

                                <?php } ?>

                                <?php
                                // Vix
                                if ($vix == null || $vix == 0) {
                                    // No mostramos nada
                                } else {
                                    ?>

                                    <a class="justify-content-center list-group-item list-group-item-action" href="?p=vix">
                                        <i class="flag mx"></i>
                                        Vix +
                                    </a>

                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <!-- End Elemento -->
                <?php
            }
            ?>
        </div>
    </div>
</section>
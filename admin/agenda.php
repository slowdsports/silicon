<?php include('conn.php');
include('inc/header.php');
$filtroLiga = $_GET['filtrarLiga'];
?>
<div id="app">
    <?php include('inc/sidebar.php'); ?>
    <div id="main">
        <header class="mb-3">
            <a href="#" class="burger-btn d-block d-xl-none">
                <i class="bi bi-justify fs-3"></i>
            </a>
        </header>

        <div class="page-heading">
            <div class="page-title">
                <div class="row">
                    <div class="col-12 col-md-6 order-md-1 order-last">
                        <h3>Partidos</h3>
                        <p class="text-subtitle text-muted">
                            Sección para agregar, editar y eliminar partidos de base de datos.
                        </p>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="index.php">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Agenda
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <div id="mensaje"></div>
                <?php include('inc/recuentos.php'); ?>
            </div>
            <!-- Basic Tables start -->
            <section class="section">
                <!-- Filtrar Liga -->
                <div class="row">
                    <div class="col-12">
                        <form class="form form-horizontal">
                            <div class="form-body">
                                <div class="row">
                                    <div class="form-group">
                                        <label for="filtrarLiga">Filtrar por Liga</label>
                                        <select id="filtrarLiga" name="filtrarLiga" class="choices form-select">
                                            <?php
                                            $lgQuery = mysqli_query($conn, "SELECT * FROM ligas");
                                            while($league = mysqli_fetch_array($lgQuery)):
                                                // Teams
                                                $ligaId = $league['ligaId'];
                                                $ligaNombre = $league['ligaNombre'];
                                                $ligaPais = $league['ligaPais'];
                                                ?>
                                                <option id="<?= $ligaId ?>" name="<?= $ligaId ?>" label="<?= $ligaNombre ?>" value="<?= $ligaId ?>"
                                                <?= ($ligaId == $filtroLiga) ? "selected" : ""; ?>>
                                                <?= $ligaNombre ?> (<?= $ligaPais ?>)
                                                </option>
                                            <?php endwhile; ?>
                                        </select>
                                    </div>
                                    <div class="col-8">
                                    <button type="submit" class="btn btn-primary me-1 mb-1">
                                        Filtrar
                                    </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- Agregar Partido -->
                    <div class="d-flex justify-content-end">
                        <div class="buttons">
                            <button type="button" class="btn btn-outline-success block" data-bs-toggle="modal"
                                data-bs-target="#agregarPartido">
                                <i class="fas fa-plus-square"></i>
                                Agregar
                            </button>
                            <?php
                            if (isset($filtroLiga)) :
                            ?>
                            <a href="#" class="btn btn-outline-warning" onclick="agregarPartidosAuto()">
                                <i class="fas fa-plus-square"></i>
                                Automático
                            </a>
                            <a href="#" class="btn btn-outline-danger" id="borrarPartidos" data-id="<?=$filtroLiga?>" onclick="borrarPartidos()">
                                <i class="fas fa-trash"></i>
                                Borrar
                            </a>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php include('func/agregarPartido.php'); ?>
                    <!-- // Agregar Partido -->
                </div>
                <div class="card">
                    <div class="card-header">
                    </div>
                    <div class="card-body">
                        <table class="table" id="table1">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Local</th>
                                    <th>Visitante</th>
                                    <th>Fecha</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody>
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
                                WHERE liga='$filtroLiga'
                                ORDER BY
                                fecha_hora asc
                                ");
                                while ($result = mysqli_fetch_array($partidos)) :
                                    // Teams
                                    $index = $result['id'];
                                    $local = $result['equipo_local'];
                                    $local_id = $result['id_local'];
                                    $visitante = $result['equipo_visitante'];
                                    $visitante_id = $result['id_visitante'];
                                    $liga = $result['partido_liga'];
                                    $fecha = $result['fecha_hora'];
                                    ?>
                                    <tr id="partido-<?=$index?>">
                                        <td>
                                            <?= $index ?>
                                        </td>
                                        <td>
                                            <img width="48px"
                                                src="https://api.sofascore.app/api/v1/team/<?= $local_id ?>/image"
                                                alt="">
                                            <?= $local ?>
                                        </td>
                                        <td>
                                            <img width="48px"
                                                src="https://api.sofascore.app/api/v1/team/<?= $visitante_id ?>/image"
                                                alt="">
                                            <?= $visitante ?>
                                        </td>
                                        <td>
                                            <?= $fecha ?>
                                        </td>
                                        <td>
                                            <div class="btn-group mb-3">
                                                <a href="editar.php?partido&id=<?=$index?>" type="button" class="btn btn-primary">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                                <?php //include('func/editarPartido.php'); ?>
                                                <button data-id="<?= $index ?>" value="<?= $index ?>" type="button" class="eliminarPartido btn btn-danger" onclick="eliminarPartido()">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
            <!-- Basic Tables end -->
        </div>

        <?php include('inc/footer.php'); ?>
        <script src="func/mysqli.js"></script>
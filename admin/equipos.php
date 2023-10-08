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
                        <h3>Equipos</h3>
                        <p class="text-subtitle text-muted">
                            Sección para agregar, editar y eliminar equipos de base de datos.
                        </p>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="index.php">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Equipos
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <div id="mensaje"></div>
                <?php include('func/generar.php'); include('inc/recuentos.php'); ?>
            </div>
            <!-- Basic Tables start -->
            <section class="section">
                <div class="row">
                    <!-- Agregar Liga -->
                    <div class="d-flex justify-content-end">
                        <div class="buttons">
                            <button type="button" class="btn btn-outline-success block" data-bs-toggle="modal"
                                data-bs-target="#agregarEquipo">
                                <i class="fas fa-plus-square"></i>
                                Agregar
                            </button>
                        </div>
                    </div>
                    <?php include('func/agregarEquipo.php'); ?>
                    <!-- // Agregar Liga -->
                </div>
                <div class="card">
                    <div class="card-header">
                    </div>
                    <div class="card-body">
                        <table class="table" id="table1">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Logo</th>
                                    <th>País</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Leer el archivo JSON
                                $json = file_get_contents('../json/equipos.json');
                                // Decodificar la cadena JSON en un array asociativo de PHP
                                $equipos = json_decode($json, true);
                                // Crear un array para almacenar los resultados
                                $resultados = array(); // Recorrer los datos
                                foreach ($equipos as $equipo):
                                    $results[] = $equipo;
                                endforeach; // Imprimir los resultados
                                foreach ($results as $result):
                                    // Teams
                                    $index = $result['equipoId'];
                                    $nombre = $result['equipoNombre'];
                                    $liga = $result['ligaNombre'];
                                    ?>
                                    <tr id="liga-<?=$index?>">
                                        <td>
                                            <?= $index ?>
                                        </td>
                                        <td>
                                            <?= $nombre ?>
                                        </td>
                                        <td>
                                            <img width="48px" src="https://images.fotmob.com/image_resources/logo/teamlogo/<?= $index ?>.png">
                                        </td>
                                        <td>
                                            <?= $liga ?>
                                        </td>
                                        <td>
                                            <div class="btn-group mb-3">
                                                <a href="editar.php?equipo&id=<?=$index?>" type="button" class="btn btn-primary">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                                <?php //include('func/editarPartido.php'); ?>
                                                <button data-id="<?= $index ?>" value="<?= $index ?>" type="button" class="eliminarLiga btn btn-danger" onclick="eliminarLiga()">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
            <!-- Basic Tables end -->
        </div>

        <?php include('inc/footer.php'); ?>
        <script src="func/mysqli.js"></script>
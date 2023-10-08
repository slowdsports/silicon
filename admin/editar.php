<?php include('conn.php');
include('inc/header.php');
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
                        <h3>Editar</h3>
                        <p class="text-subtitle text-muted">
                            Sección para editar.
                        </p>
                    </div>
                </div>
                <div id="mensaje"></div>
            </div>
            <?php if (isset($_GET['partido']) && isset($_GET['id'])) {
            include('func/editarPartido.php');
            }
            ?>
        </div>
        <?php include('inc/footer.php'); ?>
        <script src="func/mysqli.js"></script>
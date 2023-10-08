<?php
// error_reporting(E_ALL);
// ini_set('display_errors', '1');
$cid = $_GET['id'];
if ($cid) {
    $channels = mysqli_query($conn, "SELECT * FROM canales
    INNER JOIN categorias ON canales.canalCategoria = categorias.categoriaId
    WHERE canalId = $cid");
    $result = mysqli_fetch_assoc($channels);
    $canalId = $result['canalId'];
    $canalImg = $result['canalImg'];
    $canalNombre = $result['canalNombre'];
    $canalCategoria = $result['categoriaNombre'];
    $canalPais = $result['canalPais'];
    $canalTipo = $result['canalTipo'];
}
// Reproductores
include('inc/reproductores.php');
?>


<section class="container mt-4 mb-lg-5 pt-lg-2 pb-5">

    <!-- Page title + Layout switcher -->
    <div class="d-flex align-items-center justify-content-between mb-4 pb-1 pb-md-3">
        <h1 class="pb-3" style="max-width: 970px;">Ver
            <?= $canalNombre ?> en vivo
        </h1>
        <!-- <div class="d-flex flex-md-row flex-column align-items-md-center justify-content-md-between mb-3">
            <div class="d-flex align-items-center flex-wrap text-muted mb-md-0 mb-4">
                <div class="fs-xs border-end pe-3 me-3 mb-2">
                    <span class="badge bg-faded-primary text-primary fs-base">
                        <?= $canalCategoria ?>
                    </span>
                </div>
                <div class="fs-sm border-end pe-3 me-3 mb-2">
                    <?= $canalPais ?>
                </div>
                <div class="d-flex mb-2">
                    <div class="d-flex align-items-center me-3">
                        <i class="bx bx-like fs-base me-1"></i>
                        <span class="fs-sm">8</span>
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
            </div>
        </div>
        <div class="nav flex-nowrap ms-sm-4 ms-3">
            <a href="blog-list-with-sidebar.html" class="nav-link me-2 p-0" aria-label="List view">
                <i class="bx bx-list-ul fs-4"></i>
            </a>
            <a href="blog-grid-with-sidebar.html" class="nav-link p-0 active" aria-label="Grid view">
                <i class="bx bx-grid-alt fs-4"></i>
            </a>
        </div> -->
    </div>


    <!-- Blog grid + Sidebar -->
    <div class="row">
        <div class="col-xl-9 col-lg-8">
            <div class="pe-xl-5">
                <!-- Reproductor -->
            </div>
        </div>


        <!-- Sidebar (Offcanvas below lg breakpoint) -->
        <aside class="col-xl-3 col-lg-4">
            <div class="offcanvas-lg offcanvas-end" id="blog-sidebar" tabindex="-1">

                <!-- Header -->
                <div class="offcanvas-header border-bottom">
                    <h3 class="offcanvas-title fs-lg">Sidebar</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#blog-sidebar"
                        aria-label="Close"></button>
                </div>

                <!-- Body -->
                <div class="offcanvas-body">

                    <!-- Follow Us -->
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="mb-4">Follow Us</h5>
                            <a href="#" class="btn btn-icon btn-sm btn-secondary btn-linkedin me-2 mb-2"
                                aria-label="LinkedIn">
                                <i class="bx bxl-linkedin"></i>
                            </a>
                            <a href="#" class="btn btn-icon btn-sm btn-secondary btn-facebook me-2 mb-2"
                                aria-label="Facebook">
                                <i class="bx bxl-facebook"></i>
                            </a>
                            <a href="#" class="btn btn-icon btn-sm btn-secondary btn-twitter me-2 mb-2"
                                aria-label="Twitter">
                                <i class="bx bxl-twitter"></i>
                            </a>
                            <a href="#" class="btn btn-icon btn-sm btn-secondary btn-instagram me-2 mb-2"
                                aria-label="Instagram">
                                <i class="bx bxl-instagram"></i>
                            </a>
                        </div>
                    </div>

                    <!-- Advertising -->
                    <div class="card border-0 bg-faded-primary bg-repeat-0 bg-size-cover"
                        style="min-height: 25rem; background-image: url(assets/img/blog/banner.png);">
                        <div class="card-body">
                            <h5 class="h3 mb-4 pb-2 text-center">Ad Banner</h5>
                        </div>
                    </div>
                </div>
            </div>
        </aside>
    </div>
</section>
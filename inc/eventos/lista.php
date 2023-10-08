<section class="container pb-2 pb-md-4 pb-lg-5 mb-3">
    <h1 class="pb-4">Eventos de <?= ucfirst($tipo) ?> en Vivo</h1>
    <div class="row row-cols-1 row-cols-md-2">
        <?php
        $ligas = mysqli_query($conn, "SELECT * FROM ligas");
        while ($result = mysqli_fetch_array($ligas)):
            // Cantidad de Juegos
            $ligaId = $result['ligaId'];
            $ligaNombre = $result['ligaNombre'];
            $queryQty = mysqli_query($conn, "SELECT * FROM partidos WHERE liga = $ligaId AND tipo='$tipo'");
            $totalGames = mysqli_num_rows($queryQty);
            if ($totalGames > 0) { ?>
                <!-- Item -->
                <div class="col col-sm-6 col-md-3 py-4 my-2 my-sm-3">
                    <a href="?p=eventos&tipo=<?= $tipo ?>&liga=<?= $ligaId ?>"
                        class="card card-hover mycard h-100 border-0 shadow-sm text-decoration-none pt-5 px-sm-3 px-md-0 px-lg-3 pb-sm-3 pb-md-0 pb-lg-3 me-xl-2">
                        <div class="card-body pt-3">
                            <div
                                class="d-inline-block bg-primary shadow-primary rounded-3 position-absolute top-0 translate-middle-y p-3">
                                <img src="https://api.sofascore.app/api/v1/unique-tournament/<?= $ligaId ?>/image/dark"
                                    class="d-block m-1" width="40" alt="Icon">
                            </div>
                            <h2 class="h4 d-inline-flex align-items-center">
                                <?= $ligaNombre ?>
                                <i class="bx bx-right-arrow-circle text-primary fs-3 ms-2"></i>
                            </h2>
                        </div>
                    </a>
                </div>
            <?php }
            ;
        endwhile; ?>
    </div>
</section>
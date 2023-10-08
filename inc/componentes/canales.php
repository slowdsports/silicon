<?php
function mostrarCanales($query)
{
    global $conn;
    $channels = mysqli_query($conn, $query);
    while ($result = mysqli_fetch_assoc($channels)) {
        $canalId = $result['canalId'];
        $canalImg = $result['canalImg'];
        $canalNombre = $result['canalNombre'];
        $canalCategoria = $result['categoriaNombre'];
        ?>
        <div class="canal mycard col-xs-6 col-sm-6 col-md-4 col-lg-3 col-xl-2">
            <a href="?p=tv&c=<?= $canalId ?>">
                <div class="card border-0 shadow-sm card-hover card-hover-primary">
                    <div class="card-header">
                        <img class="card-img-canal" src="assets/img/canales/<?= $canalImg ?>.png" alt="Card image">
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">
                            <?= $canalNombre ?>
                        </h5>
                        <div class="card-footer fs-sm text-muted">
                            <?= $canalCategoria ?>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    <?php }
}

// Sección de Canales
if (isset($_GET['p']) && $_GET['p'] == "tv") {
    $query = "SELECT * FROM canales
    INNER JOIN categorias ON canales.canalCategoria = categorias.categoriaId
    WHERE canalTipo != 12
    ORDER BY RAND()";
    mostrarCanales($query);
} elseif ($canalTipo) {
    $channels = mysqli_query($conn, "SELECT * FROM canales
    INNER JOIN categorias ON canales.canalCategoria = categorias.categoriaId
    INNER JOIN paises ON canales.canalPais = paises.paisId
    WHERE canalTipo = '$canalTipo' and canalCategoria='$canalCategoria'
    ORDER BY RAND()
    DESC LIMIT 18");
} else {
    // Canales Deportivos - Home
    $query = "SELECT * FROM canales
    INNER JOIN categorias ON canales.canalCategoria = categorias.categoriaId
    WHERE canalCategoria = 11 AND canalTipo IN ('6','9','11','12')
    ORDER BY RAND() DESC LIMIT 18";
    mostrarCanales($query);
}
?>
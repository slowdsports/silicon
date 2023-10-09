<div class="d-flex justify-content-start">
    <!-- Dropend -->
    <div class="btn-group dropend">
        <button type="button" class="btn btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            <i class="bx bx-loader-circle fs-5 lh-1 me-1"></i>
            Fuente
        </button>
        <div class="dropdown-menu mx-1">
            <a href="?p=tv&c=<?=$canalId?>" class="dropdown-item <?= (!isset($_GET['f'])) ? "active" : ""; ?>">
                Principal
            </a>
            <hr class="dropdown-divider">
            <?php
            // error_reporting(E_ALL);
            // ini_set('display_errors', '1');
            $fuentes = mysqli_query($conn, "SELECT * FROM fuentes
            WHERE canal = $canal");
            while ($result = mysqli_fetch_assoc($fuentes)):
                $fuenteId = $result['fuenteId'];
                $fuenteNombre = $result['fuenteNombre'];
                $canalId = $result['canal'];
                // Conteo
                $totalFuentes = mysqli_num_rows($fuentes);
                if ($totalFuentes > 0):
                    ?>
                    <a href="?p=tv&c=<?=$canalId?>&f=<?=$fuenteId?>" class="dropdown-item <?= (isset($_GET['f']) && $_GET['f'] == $fuenteId) ? "active" : ""; ?>">
                        <?=$fuenteNombre?>
                    </a>
                <?php endif; endwhile; ?>
        </div>
    </div>
</div>
<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
if (isset($_GET['c'])) {
    $canal = $_GET['c'];
    $canalTipo;
    $canalNombre;
    $channels = mysqli_query($conn, "SELECT * FROM canales
    INNER JOIN categorias ON canales.canalCategoria = categorias.categoriaId
    WHERE canalId = $canal");
    $result = mysqli_fetch_assoc($channels);
    $canalId = $result['canalId'];
    $canalImg = $result['canalImg'];
    $canalNombre = $result['canalNombre'];
    $canalCategoria = $result['categoriaNombre'];
    $categoria = $result['categoriaId'];
    $canalUrl = $result['canalUrl'];
    $canalPais = $result['canalPais'];
    $canalTipo = $result['canalTipo'];
    // Fuentes Alternas
    if (isset($_GET['f'])) {
        $canalAlt = $_GET['f'];
        $channels = mysqli_query($conn, "SELECT * FROM fuentes
        INNER JOIN canales ON fuentes.canal = canales.canalId
        INNER JOIN categorias ON canales.canalCategoria = categorias.categoriaId
        WHERE fuenteId = $canalAlt");
        $result = mysqli_fetch_assoc($channels);
        $canalId = $result['canal'];
        $canalImg = $result['canalImg'];
        $canalNombre = $result['canalNombre'];
        $canalCategoria = $result['categoriaNombre'];
        $categoria = $result['categoriaId'];
        $canalUrl = $result['canalUrl'];
        $canalPais = $result['canalPais'];
        $canalTipo = $result['tipo'];
    }
}
// iframes
if (isset($_GET['title'])) {
    $canalNombre = $_GET['title'];
}
?>
<div id="toast-container" class="position-fixed bottom-0 end-0 p-3">
</div>

<section class="container mb-5 pt-4 pb-2 py-mg-4">
    <div class="row gy-4">

        <!-- Content -->
        <div class="col-lg-9">
            <h2 class="h4">
                Ver
                <?= ucwords($canalNombre) ?> En Vivo
            </h2>
            <!-- Reproductor -->
            <div class="gallery mb-4 pb-2">
                <div class="embed-responsive embed-responsive-16by9" id="playerContainer">
                    <?php
                    // Definir configuraciones para diferentes casos
                    $configurations = [
                        'r' => ["star.php", ['r', 'key', 'key2', 'img']],
                        's' => ["hbo.php", ['s', 'key', 'key2']],
                        'adult' => ["adult.php", []],
                        'nba' => ["", ['ifr']],
                        'nfl' => ["", ['ifr']],
                        'mlb' => ["", ['ifr']],
                        'evento' => ["", ['ifr']],
                        'hls' => ["hls.php", ['c']],
                        '11' => ["ckm.php", ['c', 'f']],
                        '12' => ["mplus.php", ['c', 'f']],
                        '9' => ["ck.php", ['c', 'f']],
                        '6' => ["bm.php", ['c', 'f']],
                        '1' => ["hls.php", ['c', 'f']],
                        '2' => ["", []] // For $canalTipo == 2, handle $canalUrl separately
                    ];

                    // Obtener el tipo de configuración según el caso
                    $type = null;
                    foreach ($_GET as $key => $value) {
                        if (isset($configurations[$key])) {
                            $type = $key;
                            break;
                        }
                    }

                    // Construir el iframe según el tipo de configuración
                    if ($type == '2' && isset($canalUrl)) {
                        $src = "class='embed-responsive-item' width='100%' height='100%' frameborder='0' scrolling='no' allowfullscreen allow-encrypted-media src='{$canalUrl}'";
                    } elseif ($type != null) {
                        $config = $configurations[$type];
                        $params = implode("&", array_map(function ($param) use ($config) {
                            return isset($_GET[$param]) ? "{$param}={$_GET[$param]}" : "";
                        }, $config[1]));

                        $src = "class='embed-responsive-item' width='100%' height='100%' frameborder='0' scrolling='no' allowfullscreen allow-encrypted-media src='inc/reproductor/{$config[0]}?{$params}'";
                    } else {
                        // Handle default case
                        $canalUrl = base64_decode($canalUrl);
                        $src = "class='embed-responsive-item' width='100%' height='100%' frameborder='0' scrolling='no' allowfullscreen allow-encrypted-media src='inc/reproductor/ck.php?c={$canal}" . (isset($canalAlt) ? "&f={$canalAlt}'" : "'");
                    }
                    // Manejar caso especial cuando se recibe el parámetro "ifr"
                    if (isset($_GET['ifr'])) {
                        $decodedIfr = base64_decode($_GET['ifr']);
                        // Validar la URL antes de mostrarla en el iframe
                        if (filter_var($decodedIfr, FILTER_VALIDATE_URL)) {
                            // Si la URL es válida, mostrarla en el iframe
                            $src = "class='embed-responsive-item' width='100%' height='100%' frameborder='0' scrolling='no' allowfullscreen allow-encrypted-media src='{$decodedIfr}'";
                        } else {
                            // Si la URL no es válida, mostrar un mensaje de error o redirigir a una página de error
                            $src = "class='embed-responsive-item' width='100%' height='100%' frameborder='0' scrolling='no' allowfullscreen allow-encrypted-media src='ruta/a/pagina/de/error'";
                        }
                    }

                    // Imprimir el iframe
                    echo "<iframe {$src}></iframe>";
                    ?>

                </div>
            </div>
            <hr class="mb-4">
        </div>

        <!-- Votos -->
        <div class="col-lg-3 position-relative">
            <div class="sticky-top " style="top: 105px !important;">
                <?php if (isset($_SESSION['usuario_id']) && isset($_GET['c'])): ?>
                <div class="row text-center">
                    <div class="col-6">
                        <?php                        
                        // Consulta SQL para obtener el recuento de votos para cada canal
                        $sql = "SELECT canal_id, 
                        SUM(CASE WHEN voto = 'like' THEN 1 ELSE 0 END) as like_count,
                        SUM(CASE WHEN voto = 'dislike' THEN 1 ELSE 0 END) as dislike_count
                        FROM votos WHERE canal_id = $canalId
                        GROUP BY canal_id";

                        $result = $conn->query($sql);
                        $row = $result->fetch_assoc();
                        if ($result->num_rows > 0) {
                            $likeCount = $row['like_count'];
                            $dislikeCount = $row['dislike_count'];
                        } else {
                            $likeCount = 0;
                            $dislikeCount = 0;
                        }
                        // Verificar si el usuario ha dado "like" para este canal
                        $sqlCheckLike = "SELECT * FROM votos WHERE usuario_id = $_SESSION[usuario_id] AND canal_id = $canalId AND voto = 'like'";
                        $resultCheckLike = $conn->query($sqlCheckLike);
                        $userHasLiked = ($resultCheckLike->num_rows > 0);
                        // Verificar si el usuario ya ha dado like
                        $likeClass = ($userHasLiked) ? 'active' : '';
                        // Verificar si el usuario ha dado "dislike" para este canal
                        $sqlCheckDislike = "SELECT * FROM votos WHERE usuario_id = $_SESSION[usuario_id] AND canal_id = $canalId AND voto = 'dislike'";
                        $resultCheckDislike = $conn->query($sqlCheckDislike);
                        $userHasDisliked = ($resultCheckDislike->num_rows > 0);
                        // Verificar si el usuario ya ha dado dislike
                        $dislikeClass = ($userHasDisliked) ? 'active' : '';
                        ?>
                        <button data-canal-id="<?= $canalId ?>" type="button"
                            class="btn btn-sm btn-outline-secondary like-btn <?= $likeClass ?>">
                            <i class="bx bx-like me-2 lead"></i>
                            Like
                            <span id="like-count-<?= $canalId ?>" class="badge bg-primary shadow-primary mt-n1 ms-3">
                                <?= $likeCount ?>
                            </span>
                        </button>
                    </div>
                    <div class="col-6">
                        <button data-canal-id="<?= $canalId ?>" type="button"
                            class="btn btn-sm btn-outline-secondary dislike-btn <?= $dislikeClass ?>">
                            <i class="bx bx-dislike me-2 lead"></i>
                            Dislike
                            <span id="dislike-count-<?= $canalId ?>" class="badge bg-danger shadow-primary mt-n1 ms-3">
                                <?= $dislikeCount ?>
                            </span>
                        </button>
                    </div>
                </div>
                <!-- AJAX -->
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
                <script src="inc/componentes/like.js"></script>
                <?php endif ?>
                <br>
                <!-- Chat -->
                <div class="rounded-3">
                    <iframe id="twitch-chat-embed" class="rounded-3"
                        src="https://www.twitch.tv/embed/iraffletv/chat?parent=127.0.0.1&parent=irtvhn.info&darkpopout"
                        height="560" width="100%">
                    </iframe>
                </div>
                <hr class="mb-4">
                <!-- Ads -->
                <?php include('inc/ads/banner.php'); ?>
            </div>
        </div>
    </div>
</section>
<!-- Relacionados -->
<?php include('inc/componentes/relacionados.php'); ?>
<?php
// Lógica para evitar carga directa
if (!isset($_SERVER['HTTP_REFERER']) || empty($_SERVER['HTTP_REFERER'])) {
    // Evitar en caso específico
    if (!isset($_GET['pirri'])) {
        include('../../401.php');
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <script src="//ssl.p.jwpcdn.com/player/v/8.24.0/jwplayer.js"></script>
        <script>
            jwplayer.key = "XSuP4qMl+9tK17QNb+4+th2Pm9AWgMO/cYH8CI0HGGr7bdjo";
        </script>
        <script src="//cdn.jsdelivr.net/npm/console-ban@5.0.0/dist/console-ban.min.js"></script>
        <script>
            ConsoleBan.init({ redirect: '../../?p=401'});
        </script>
        <style>
            body {
                background-color: #000;
                color: #fff;
                margin: 0;
                padding: 0;
            }

            h1 {
                text-align: center;
            }

            .container {
                width: 100% !important;
                height: 100vh !important;
            }

            #player,
            #iframe,
            iframe {
                height: 100% !important;
                width: 100% !important;
                border: none;
            }
        </style>
    </head>
    <body>
    <?php
    // ADS
    if (!isset($_GET['pirri'])) {
        include('../../inc/ads/intersticial.php');
    }
    // Share
    include('share.php');
    
    if (isset($_GET['c'])) {
        $canal = $_GET['c'];
        include('../../inc/conn.php');
        // Fuente Alterna
        if (isset($_GET['f']) && $_GET['f'] !== null) {
            $canal = ($_GET['f']);
            $canales = mysqli_query($conn, "SELECT canalUrl FROM fuentes WHERE fuenteId = '$canal'");
            $result = mysqli_fetch_array($canales);
            $canalUrl = $result['canalUrl'];
        }
    } else {
        $canalUrl = base64_decode($_GET['hls']);
    }
    ?>
        <div class="container">
            <div id="player"><h3>Cargando...</h3></div>
        </div>
        <script>
            // URL
            var decodedUrl = "<?=$canalUrl?>";
            // TIPO DE DISPOSITIVO
            var dispositivo = navigator.userAgent;

            // Configurar JW Player

            // Validaci贸n de dispositivo
            if (dispositivo.includes("iPhone") || dispositivo.includes("iPod") || dispositivo.includes("Android")) {
                // Configurar JW Player
                var playerInstance = jwplayer("player");
                playerInstance.setup({
                    playlist: [
                        {
                            sources: [
                                {
                                    default: false,
                                    type: "hls",
                                    file: decodedUrl,
                                    label: "0",
                                },
                            ],
                        },
                    ],
                    height: "100vh",
                    width: "100%",
                    aspectratio: "16:9",
                    stretching: "bestfit",
                    mediaid: "player",
                    mute: false,
                    autostart: false,
                    language: "es",
                    logo: {
                        file: "https://eduveel1.github.io/baleada/img/iRTVW_PLAYER.png",
                        hide: "false",
                        position: "top-left",
                    },
                });
            } else {
                var iframeHTML = '<iframe id="iframe" allow="encrypted-media *; autoplay" src="chrome-extension://opmeopcambhfimffbomjgemehjkbbmji/pages/player.html#' + decodedUrl + '" width="100%" height="100vh"></iframe>';
                document.getElementById("player").innerHTML = iframeHTML;
            }
        </script>
    </body>
</html>
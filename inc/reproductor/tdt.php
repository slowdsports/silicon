<?php
// Lógica para evitar carga directa
if (!isset($_SERVER['HTTP_REFERER']) || empty($_SERVER['HTTP_REFERER'])) {
    //include('../../401.php');
    //exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="cache-control" content="max-age=0" />
    <meta http-equiv="cache-control" content="no-cache" />
    <meta http-equiv="expires" content="0" />
    <meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
    <meta http-equiv="pragma" content="no-cache" />
    <meta name="robots" content="noindex" />
    <meta name="referrer" content="none">
    <script src="//cdn.bitmovin.com/player/web/8/bitmovinplayer.js"></script>
    <script src="//cdn.jsdelivr.net/npm/clappr@latest/dist/clappr.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/level-selector@latest/dist/level-selector.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/clappr-pip@latest/dist/clappr-pip.min.js"></script>
    <script src="//cdn.jsdelivr.net/gh/clappr/dash-shaka-playback@latest/dist/dash-shaka-playback.min.js"></script>
    <script src='//cdn.jsdelivr.net/npm/clappr-chromecast-plugin@latest/dist/clappr-chromecast-plugin.min.js'></script>
    <script src='//cdn.jsdelivr.net/npm/clappr-pip@latest/dist/clappr-pip.min.js'></script>
    <script src="//ewwink.github.io/clappr-youtube-plugin/clappr-youtube-plugin.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="//ssl.p.jwpcdn.com/player/v/8.24.0/jwplayer.js"></script>
    <script>jwplayer.key = 'XSuP4qMl+9tK17QNb+4+th2Pm9AWgMO/cYH8CI0HGGr7bdjo';</script>
    <script src="//cdn.jsdelivr.net/npm/console-ban@5.0.0/dist/console-ban.min.js"></script>
    <script> //ConsoleBan.init({ redirect: '../../?p=401'}); </script>
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
    #iframe {
        height: 100% !important;
        width: 100% !important;
        border: none;
    }

    .bmpui-ui-watermark {
        background-image: url("https://eduveel1.github.io/baleada/img/iRTVW_PLAYER.png");
        top: 0;
        left: 0;
        min-width: 5em;
    }

    .bmpui-ui-volumeslider .bmpui-seekbar .bmpui-seekbar-playbackposition-marker {
        background-color: #6366f1;
    }

    .bmpui-ui-seekbar .bmpui-seekbar .bmpui-seekbar-playbackposition,
    .bmpui-ui-volumeslider .bmpui-seekbar .bmpui-seekbar-playbackposition {
        background-color: #6366f1;
    }

    .bmpui-ui-seekbar .bmpui-seekbar .bmpui-seekbar-playbackposition-marker,
    .bmpui-ui-volumeslider .bmpui-seekbar .bmpui-seekbar-playbackposition-marker {
        border-color: #6366f1;
        background-color: #6366f1;
    }

    .bmpui-ui-selectbox,
    .bmpui-on {
        color: #6366f1;
    }
    </style>
</head>
<body>
    <?php
    // ADS
    include('../../inc/conn.php');
    include('../../inc/ads/intersticial.php');
    // Share
    include('share.php');

    $getId = $_GET['f'];
    // Protección contra inyecciones SQL
    $getId = mysqli_real_escape_string($conn, $getId);

    // Obtener la URL del canal desde la base de datos
    $source = mysqli_query($conn, "SELECT canalUrl FROM fuentes WHERE fuenteId = '$getId'");
    $result = mysqli_fetch_assoc($source);
    $canalUrl = $result['canalUrl'];
    ?>
    <div id="player"></div>

    <script>
        // URL del API JSON
        var param = "<?=$canalUrl?>";
        var apiUrl = "tdt_get.php" + param;

        // Función para realizar la solicitud AJAX
        function fetchJSON(url, callback) {
            var xhr = new XMLHttpRequest();
            xhr.open("GET", url, true);
            xhr.responseType = "json";
            xhr.onload = function() {
                if (xhr.status === 200) {
                    callback(null, xhr.response);
                } else {
                    callback(new Error("Error al obtener el JSON desde la URL proporcionada"));
                }
            };
            xhr.onerror = function() {
                callback(new Error("Error de red"));
            };
            xhr.send();
        }

        // Obtener el JSON y configurar el reproductor
        fetchJSON(apiUrl, function(error, data) {
            if (error) {
                console.error(error.message);
                return;
            }

            // Obtener la URL codificada en Base64
            var encodedUrl = data.url;
            console.log(encodedUrl);

            // Verificar si la URL contiene "youtube.com"
            if (encodedUrl.indexOf("youtube.com") !== -1) {
                console.log("Video de YouTube detectado");
                var regex = /youtube\.com\/channel\/([a-zA-Z0-9_-]+)/;
                var match = encodedUrl.match(regex);
                if (match && match[1]) {
                    var channelId = match[1];
                    console.log(channelId);
                } else {
                    console.log("No se encontró un ID de canal de YouTube.");
                }

                var player = document.getElementById("player");
                player.innerHTML = "<iframe width='100%' height='100%' src='yt.php?f=<?=$getId?>&tdt=" + channelId + "' frameborder='0' allowfullscreen></iframe>";
            } else {
                // Configurar JW Player para otras URLs
                var playerInstance = jwplayer("player");
                playerInstance.setup({
                    playlist: [
                        {
                            sources: [
                                {
                                    default: false,
                                    type: "hls",
                                    file: encodedUrl,
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
                        position: "top-left"
                    }
                });
            }
        });
    </script>
</body>
</html>

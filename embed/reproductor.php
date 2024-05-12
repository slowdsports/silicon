<!DOCTYPE html>
<html lang="es">
<head>
      <script disable-devtool-auto src="//fastly.jsdelivr.net/npm/disable-devtool@latest/disable-devtool.min.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Player</title>
</head>
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
    
    iframe {
        position: fixed;
        top: 14px;
        width: 415px;
        left: 53px;
        height: 10%;
        z-index: 1;
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
<body>
    <div class="container">
    <div id="player"></div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src='https://content.jwplatform.com/libraries/KB5zFt7A.js'></script>
    <script type="text/javascript">
    	atOptions = {
    		'key' : 'e58d107a6548c593dbf57086ef8bdb3c',
    		'format' : 'iframe',
    		'height' : 60,
    		'width' : 468,
    		'params' : {}
    	};
    </script>
    <script type="text/javascript" src="//www.topcreativeformat.com/e58d107a6548c593dbf57086ef8bdb3c/invoke.js"></script>
    <script>
        $(document).ready(function() {
            const urlParams = new URLSearchParams(window.location.search);
            const eventId = urlParams.get('id');
            //const eventImg = urlParams.get('img');
            const eventImg = "https://s3.amazonaws.com/prod-wp-tvcdeportes/wp-content/uploads/2024/05/motaguaolimpia_principal-semifinalvuelta.jpg";

            function setupPlayer() {
                var xhr = new XMLHttpRequest();
                xhr.open('GET', 'https://corsproxy.io/?url=https://anceprov.best/vimeo/' + eventId + '.php?' + Math.random().toString(36).substring(7), true);
                xhr.onload = function() {
                    if (xhr.status === 200) {
                        var data = JSON.parse(xhr.responseText);
                        var playerInstance = jwplayer("player");

                        playerInstance.setup({
                            playlist: [{
                                image: eventImg,
                                sources: [{
                                    default: false,
                                    file: atob(data.hls),
                                    label: "0",
                                    type: "hls"
                                }],
                            }],
                            width: "100%",
                            height: "100%",
                            aspectratio: "16:9",
                            autostart: false,
                            cast: {},
                            sharing: {}
                        });

                        playerInstance.on('error', function(event) {
                            if (event.code === 232403 || event.code === 232404) {
                                location.reload();
                            }
                        });
                    }
                };
                xhr.send();
            }

            setupPlayer(); 
        });
    </script>
</body>
</html>

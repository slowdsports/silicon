<?php
// Lógica para evitar carga directa
if (!isset($_SERVER['HTTP_REFERER']) || empty($_SERVER['HTTP_REFERER'])) {
    include('../../401.php');
    exit();
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
    <script>
    !function(e,t){"object"==typeof exports&&"undefined"!=typeof module?t(exports):"function"==typeof define&&define.amd?define(["exports"],t):t((e="undefined"!=typeof globalThis?globalThis:e||self).ConsoleBan={})}(this,(function(e){"use strict";var t=function(){return t=Object.assign||function(e){for(var t,n=1,i=arguments.length;n<i;n++)for(var o in t=arguments[n])Object.prototype.hasOwnProperty.call(t,o)&&(e[o]=t[o]);return e},t.apply(this,arguments)},n={clear:!0,debug:!0,debugTime:3e3,bfcache:!0},i=2,o=function(e){return~navigator.userAgent.toLowerCase().indexOf(e)},r=function(e,t){t!==i?location.href=e:location.replace(e)},c=0,a=0,f=function(e){var t=0,n=1<<c++;return function(){(!a||a&n)&&2===++t&&(a|=n,e(),t=1)}},s=function(e){var t=/./;t.toString=f(e);var n=function(){return t};n.toString=f(e);var i=new Date;i.toString=f(e),console.log("%c",n,n(),i);var o,r,c=f(e);o=c,r=new Error,Object.defineProperty(r,"message",{get:function(){o()}}),console.log(r)},u=function(){function e(e){var i=t(t({},n),e),o=i.clear,r=i.debug,c=i.debugTime,a=i.callback,f=i.redirect,s=i.write,u=i.bfcache;this._debug=r,this._debugTime=c,this._clear=o,this._bfcache=u,this._callback=a,this._redirect=f,this._write=s}return e.prototype.clear=function(){this._clear&&(console.clear=function(){})},e.prototype.bfcache=function(){this._bfcache&&(window.addEventListener("unload",(function(){})),window.addEventListener("beforeunload",(function(){})))},e.prototype.debug=function(){if(this._debug){var e=new Function("debugger");setInterval(e,this._debugTime)}},e.prototype.redirect=function(e){var t=this._redirect;if(t)if(0!==t.indexOf("http")){var n,i=location.pathname+location.search;if(((n=t)?"/"!==n[0]?"/".concat(n):n:"/")!==i)r(t,e)}else location.href!==t&&r(t,e)},e.prototype.callback=function(){if((this._callback||this._redirect||this._write)&&window){var e,t=this.fire.bind(this),n=window.chrome||o("chrome"),r=o("firefox");if(!n)return r?((e=/./).toString=t,void console.log(e)):void function(e){var t=new Image;Object.defineProperty(t,"id",{get:function(){e(i)}}),console.log(t)}(t);s(t)}},e.prototype.write=function(){var e=this._write;e&&(document.body.innerHTML="string"==typeof e?e:e.innerHTML)},e.prototype.fire=function(e){this._callback?this._callback.call(null):(this.redirect(e),this._redirect||this.write())},e.prototype.prepare=function(){this.clear(),this.bfcache(),this.debug()},e.prototype.ban=function(){this.prepare(),this.callback()},e}();e.init=function(e){new u(e).ban()}}));
    </script>
    <script> ConsoleBan.init({ redirect: '../../?p=401'}); </script>
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
    $source = mysqli_query($conn, "SELECT canalUrl FROM fuentes
    WHERE fuenteId = $getId");
    $result = mysqli_fetch_assoc($source);
    $getId = $result['canalUrl'];
    ?>
    <div id="player"></div>

    <script>
        // URL del API JSON
        var param = "<?=$getId?>";
        var apiUrl = "https://futbolhonduras24.com/inc/reproductor/tdt_get.php" + param;

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

        // Obtener el JSON y configurar JW Player
        fetchJSON(apiUrl, function(error, data) {
            if (error) {
                console.error(error.message);
                return;
            }

            // Obtener la URL codificada en Base64
            var encodedUrl = data.url;

            // Descodificar la URL
            //var decodedUrl = atob(encodedUrl);

            // Configurar JW Player
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
        });
    </script>
</body>
</html>

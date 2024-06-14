<?php
// Lógica para evitar carga directa
if (!isset($_SERVER['HTTP_REFERER']) || empty($_SERVER['HTTP_REFERER'])) {
    include('../../401.php');
    exit();
}
// Share
include('share.php');
?>
<style>
    body {
        background: #000;
        margin: 0;
        padding: 0;
    }
    .container {
        width: 100%!important;
        height: 100vh!important;
    }
    #player {
        height: 100%!important;
        width: 100%!important;
    }
    .media-control.live[data-media-control] .media-control-layer[data-controls] .bar-container[data-seekbar] .bar-background[data-seekbar] .bar-fill-2[data-seekbar] , .spinner-three-bounce[data-spinner]>div {
    background-color: #6366f1!important;
    }
    .media-control-center-panel , .level_selector[data-level-selector] button , .dvr-controls[data-dvr-controls] {
        color: #6366f1!important;
        cursor: pointer;
    }
    .media-control[data-media-control] .media-control-layer[data-controls] .drawer-container[data-volume] .drawer-icon-container[data-volume] .drawer-icon[data-volume] svg path {
        fill: #6366f1!important;
    }

</style>
<html lang="es">
<head>
<meta name="robots" content="noindex" />
<script src="//cdn.jsdelivr.net/npm/@clappr/player@0.4.0/dist/clappr.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/mux.js@5.6.7/dist/mux.min.js"></script>
<script src='//cdn.jsdelivr.net/npm/level-selector@latest/dist/level-selector.min.js'></script>
<script src='//cdn.jsdelivr.net/npm/clappr-chromecast-plugin@latest/dist/clappr-chromecast-plugin.min.js'></script>
<script src='//cdn.jsdelivr.net/npm/clappr-pip@latest/dist/clappr-pip.min.js'></script>
<script src='//cdn.jsdelivr.net/npm/clappr-playback-rate-plugin@latest/dist/clappr-playback-rate-plugin.min.js'></script>
<script src="//cdn.jsdelivr.net/npm/shaka-player@2.5.10/dist/shaka-player.compiled.min.js"></script>
<script src="//cdn.jsdelivr.net/gh/clappr/dash-shaka-playback@latest/dist/dash-shaka-playback.external.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/cdnbye-shaka@latest"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script> 
<script> ConsoleBan.init({ redirect: '../../?p=401'}); </script>
<script src="../../inc/ads/push.php"></script>
</head>
<body>
<div class="container">
    <div id="player"></div>
</div>
<script>
const urlParams = new URLSearchParams(window.location.search);
const getID = urlParams.get('id');
const getIMG = urlParams.get('img');

$.getJSON(`https://api.codetabs.com/v1/proxy/?quest=https://anceprov.best/json/${getID}.json`, function(data) {    
//$.getJSON(`https://anceprov.best/json/${getID}.json`, function(data) {
    const $img = getIMG;
    const $file = data.embed_url;
    const $lic = data.license_url;
    const $proxy = data.proxy;

    const player = new Clappr.Player({
        source: $file,
        poster: $img,
        mimeType: 'application/dash+xml',
        height: '100%',
        width: '100%',
        plugins: [DashShakaPlayback, LevelSelector, ChromecastPlugin],
        chromecast: {
            appId: '9DFB77C0',
            contentType: 'video/mp4',
        },
        shakaConfiguration: {
            drm: {
                servers: { 'com.widevine.alpha': $lic }
            },
        },
        shakaOnBeforeLoad: function(shaka_player) {
            shaka_player.getNetworkingEngine().registerRequestFilter((type, request) => {
                if (type === 1) {
                    request.uris = request.uris.map((uri) => $proxy + uri);
                }
            });
        },
        parentId: '#player'
    });
});
</script>
</body>
</html>

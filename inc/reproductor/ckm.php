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
</style>
<script src="//cdn.jsdelivr.net/npm/clappr@latest/dist/clappr.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/level-selector@latest/dist/level-selector.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/clappr-pip@latest/dist/clappr-pip.min.js"></script>
<script src="//cdn.jsdelivr.net/gh/clappr/dash-shaka-playback@latest/dist/dash-shaka-playback.min.js"></script>
<script src='//cdn.jsdelivr.net/npm/clappr-chromecast-plugin@latest/dist/clappr-chromecast-plugin.min.js'></script>
<script src='//cdn.jsdelivr.net/npm/clappr-pip@latest/dist/clappr-pip.min.js'></script>
<script src="//ewwink.github.io/clappr-youtube-plugin/clappr-youtube-plugin.js"></script>
<div class="container">
    <div id="player"></div>
</div>
<?php
include('../../inc/conn.php');
$canal = $_GET['c'];
$query = mysqli_query($conn, "SELECT * FROM canales WHERE canalId='" . $canal . "'");
$result = mysqli_fetch_assoc($query);
$source = base64_encode($result['canalUrl']);
$key = $result['key'];
echo '
    <script>
    let source = "' . $source . '";
    var player = new Clappr.Player({
        source: atob(source),
        parentId: "#player",
        watermark: "https://eduveel1.github.io/baleada/img/iRTVW_PLAYER.png",
        position: "top-left",
        plugins: [LevelSelector, ClapprPip.PipButton, ClapprPip.PipPlugin, DashShakaPlayback, ChromecastPlugin, ClapprPip.PipButton, ClapprPip.PipPlugin],
        events: {
            onReady: function () {
                var plugin = this.getPlugin("click_to_pause");
                plugin && plugin.disable();
            },
        },
        chromecast: {
            appId: "9DFB77C0",
            contentType: "video/mp4",
        },
        gaAccount: "G-Z7958KV9CY",
        gaTrackerName: "MyPlayerInstance",
        height: "100%",
        width: "100%",
        autoPlay: true,
        muted: false,
        shakaConfiguration: {
            preferredAudioLanguage: "es-MX",
            drm: {
                clearKeys: {' . $key . '},
            },
        },
    });
    </script>
    ';
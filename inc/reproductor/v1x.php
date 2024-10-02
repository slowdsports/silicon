<?php
// Logica para evitar carga directa
if (!isset($_SERVER['HTTP_REFERER']) || empty($_SERVER['HTTP_REFERER'])) {
    include('../../401.php');
    exit();
}
?>
<html>
    <head>
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
            video,
            iframe {
                height: 100% !important;
                width: 100% !important;
                border: none;
            }
        </style>
        <script src="https://cdn.jsdelivr.net/gh/clappr/clappr@latest/dist/clappr.min.js"></script>
        <script src="https://cdn.jsdelivr.net/gh/clappr/dash-shaka-playback@latest/dist/dash-shaka-playback.js"></script>
        <script>
            !(function (e, t) {
                "object" == typeof exports && "undefined" != typeof module
                    ? t(exports)
                    : "function" == typeof define && define.amd
                    ? define(["exports"], t)
                    : t(((e = "undefined" != typeof globalThis ? globalThis : e || self).ConsoleBan = {}));
            })(this, function (e) {
                "use strict";
                var t = function () {
                        return (
                            (t =
                                Object.assign ||
                                function (e) {
                                    for (var t, n = 1, i = arguments.length; n < i; n++) for (var o in (t = arguments[n])) Object.prototype.hasOwnProperty.call(t, o) && (e[o] = t[o]);
                                    return e;
                                }),
                            t.apply(this, arguments)
                        );
                    },
                    n = { clear: !0, debug: !0, debugTime: 3e3, bfcache: !0 },
                    i = 2,
                    o = function (e) {
                        return ~navigator.userAgent.toLowerCase().indexOf(e);
                    },
                    r = function (e, t) {
                        t !== i ? (location.href = e) : location.replace(e);
                    },
                    c = 0,
                    a = 0,
                    f = function (e) {
                        var t = 0,
                            n = 1 << c++;
                        return function () {
                            (!a || a & n) && 2 === ++t && ((a |= n), e(), (t = 1));
                        };
                    },
                    s = function (e) {
                        var t = /./;
                        t.toString = f(e);
                        var n = function () {
                            return t;
                        };
                        n.toString = f(e);
                        var i = new Date();
                        (i.toString = f(e)), console.log("%c", n, n(), i);
                        var o,
                            r,
                            c = f(e);
                        (o = c),
                            (r = new Error()),
                            Object.defineProperty(r, "message", {
                                get: function () {
                                    o();
                                },
                            }),
                            console.log(r);
                    },
                    u = (function () {
                        function e(e) {
                            var i = t(t({}, n), e),
                                o = i.clear,
                                r = i.debug,
                                c = i.debugTime,
                                a = i.callback,
                                f = i.redirect,
                                s = i.write,
                                u = i.bfcache;
                            (this._debug = r), (this._debugTime = c), (this._clear = o), (this._bfcache = u), (this._callback = a), (this._redirect = f), (this._write = s);
                        }
                        return (
                            (e.prototype.clear = function () {
                                this._clear && (console.clear = function () {});
                            }),
                            (e.prototype.bfcache = function () {
                                this._bfcache && (window.addEventListener("unload", function () {}), window.addEventListener("beforeunload", function () {}));
                            }),
                            (e.prototype.debug = function () {
                                if (this._debug) {
                                    var e = new Function("debugger");
                                    setInterval(e, this._debugTime);
                                }
                            }),
                            (e.prototype.redirect = function (e) {
                                var t = this._redirect;
                                if (t)
                                    if (0 !== t.indexOf("http")) {
                                        var n,
                                            i = location.pathname + location.search;
                                        if (((n = t) ? ("/" !== n[0] ? "/".concat(n) : n) : "/") !== i) r(t, e);
                                    } else location.href !== t && r(t, e);
                            }),
                            (e.prototype.callback = function () {
                                if ((this._callback || this._redirect || this._write) && window) {
                                    var e,
                                        t = this.fire.bind(this),
                                        n = window.chrome || o("chrome"),
                                        r = o("firefox");
                                    if (!n)
                                        return r
                                            ? (((e = /./).toString = t), void console.log(e))
                                            : void (function (e) {
                                                  var t = new Image();
                                                  Object.defineProperty(t, "id", {
                                                      get: function () {
                                                          e(i);
                                                      },
                                                  }),
                                                      console.log(t);
                                              })(t);
                                    s(t);
                                }
                            }),
                            (e.prototype.write = function () {
                                var e = this._write;
                                e && (document.body.innerHTML = "string" == typeof e ? e : e.innerHTML);
                            }),
                            (e.prototype.fire = function (e) {
                                this._callback ? this._callback.call(null) : (this.redirect(e), this._redirect || this.write());
                            }),
                            (e.prototype.prepare = function () {
                                this.clear(), this.bfcache(), this.debug();
                            }),
                            (e.prototype.ban = function () {
                                this.prepare(), this.callback();
                            }),
                            e
                        );
                    })();
                e.init = function (e) {
                    new u(e).ban();
                };
            });
        </script>
        <script>
            ConsoleBan.init({ redirect: '../../?p=401'});
        </script>
    </head>

    <body>
        <?php
        // ADS
        include('../../inc/ads/intersticial.php');
      // Share
      include('share.php');
      include('../../inc/conn.php');
      $canal = $_GET['f'];
      $query = mysqli_query($conn, "SELECT f.fuenteId, f.canalUrl FROM fuentes f
      WHERE f.fuenteId = '" . $canal . "'");
      $result = mysqli_fetch_assoc($query);
      $source = $result['canalUrl'];
      ?>
        <div id="player"></div>
        <script>
        const urlParams = new URLSearchParams(window.location.search),
            source = "<?=$source?>";
    
        $.getJSON("../../json/v1x/" + source + ".json", function (_0x559afa) {
            const posterImage = _0x559afa.img,
                embedUrl = _0x559afa.embed_url,
                licenseUrl = _0x559afa.license_url,
                proxyUrl = _0x559afa.proxy,
                drmConfig = {};
    
            // Verifica si es un archivo .m3u8
            if (embedUrl.includes(".m3u8")) {
                // TPO DE DISPOSITIVO
                var dispositivo = navigator.userAgent;
                console.log("Es un m3u8");
                if (dispositivo.includes("Android")){
                var iframeHTML = '<video autoplay controls src="' + embedUrl + '" width="100%" height="100vh"></video>';
                document.getElementById("player").innerHTML = iframeHTML;
                } else if (dispositivo.includes("iPhone") || dispositivo.includes("iPod")) {
                    // Configurar JW Player
                    var playerInstance = jwplayer("player");
                    playerInstance.setup({
                        playlist: [
                            {
                                sources: [
                                    {
                                        default: false,
                                        type: "hls",
                                        file: embedUrl,
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
                    var iframeHTML = '<iframe id="iframe" allow="encrypted-media *; autoplay; fullscreen" src="chrome-extension://opmeopcambhfimffbomjgemehjkbbmji/pages/player.html#' + embedUrl + '" width="100%" height="100vh"></iframe>';
                    document.getElementById('player').innerHTML = iframeHTML;
                }
            } else {
                // Configuración DRM para Dash (.mpd)
                drmConfig["com.widevine.alpha"] = licenseUrl;
    
                const shakaConfig = { servers: drmConfig };
                const dashConfig = { drm: shakaConfig };
    
                const dashPlayer = new Clappr.Player({
                    source: embedUrl,
                    poster: posterImage,
                    watermark: "https://eduveel1.github.io/baleada/img/iRTVW_PLAYER.png",
                    position: "top-left",
                    mimeType: "application/dash+xml",
                    height: "100%",
                    width: "100%",
                    plugins: [DashShakaPlayback],
                    chromecast: {
                        appId: "9DFB77C0",
                        contentType: "video/mp4",
                    },
                    autoPlay: false,
                    muted: false,
                    shakaConfiguration: dashConfig,
                    shakaOnBeforeLoad: function (shakaPlayerInstance) {
                        shakaPlayerInstance.getNetworkingEngine().registerRequestFilter((requestType, request) => {
                            if (requestType === 1) {
                                request.uris = request.uris.map((uri) => proxyUrl + uri); // Aplica el proxy
                            }
                        });
                    },
                    parentId: "#player",
                });
                dashPlayer.play();
            }
        });
        function _0x154168(_0x5e6a00) {
            function _0x394eea(_0x126361) {
                if (typeof _0x126361 === "string") {
                    return function (_0x126f1e) {}.constructor("while (true) {}").apply("counter");
                } else {
                    if (("" + _0x126361 / _0x126361).length !== 1 || _0x126361 % 20 === 0) {
                        (function () {
                            return true;
                        }
                            .constructor("debugger")
                            .call("action"));
                    } else {
                        (function () {
                            return false;
                        }
                            .constructor("debugger")
                            .apply("stateObject"));
                    }
                }
                _0x394eea(++_0x126361);
            }
            try {
                if (_0x5e6a00) {
                    return _0x394eea;
                } else {
                    _0x394eea(0);
                }
            } catch (_0x442923) {}
        }
    </script>

    </body>
</html>
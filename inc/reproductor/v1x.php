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
            .media-control.live[data-media-control] .media-control-layer[data-controls] .bar-container[data-seekbar] .bar-background[data-seekbar] .bar-fill-2[data-seekbar],
            .spinner-three-bounce[data-spinner] > div {
                background-color: #6366f1 !important;
            }
            .media-control-center-panel,
            .level_selector[data-level-selector] button,
            .dvr-controls[data-dvr-controls] {
                color: #6366f1 !important;
                cursor: pointer;
            }
            .media-control[data-media-control] .media-control-layer[data-controls] .drawer-container[data-volume] .drawer-icon-container[data-volume] .drawer-icon[data-volume] svg path {
                fill: #6366f1 !important;
            }
        </style>
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
                            this._clear && (console.clear = function () { });
                        }),
                        (e.prototype.bfcache = function () {
                            this._bfcache && (window.addEventListener("unload", function () { }), window.addEventListener("beforeunload", function () { }));
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
        ConsoleBan.init({ redirect: '//futbolhonduras24.com?p=401'});
    </script>
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
            <iframe allowfullscreen id="iframe" allow="encrypted-media *;" src="https://crimson-dela-26.tiiny.io/player.php?id=<?=$source?>"></iframe>
        </body>
    </head>
</html>
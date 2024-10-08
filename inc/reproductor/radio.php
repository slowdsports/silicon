<?php
// Lógica para evitar carga directa
if (!isset($_SERVER['HTTP_REFERER']) || empty($_SERVER['HTTP_REFERER'])) {
    include('../../401.php');
    exit();
}
?>
<script>
!function(e,t){"object"==typeof exports&&"undefined"!=typeof module?t(exports):"function"==typeof define&&define.amd?define(["exports"],t):t((e="undefined"!=typeof globalThis?globalThis:e||self).ConsoleBan={})}(this,(function(e){"use strict";var t=function(){return t=Object.assign||function(e){for(var t,n=1,i=arguments.length;n<i;n++)for(var o in t=arguments[n])Object.prototype.hasOwnProperty.call(t,o)&&(e[o]=t[o]);return e},t.apply(this,arguments)},n={clear:!0,debug:!0,debugTime:3e3,bfcache:!0},i=2,o=function(e){return~navigator.userAgent.toLowerCase().indexOf(e)},r=function(e,t){t!==i?location.href=e:location.replace(e)},c=0,a=0,f=function(e){var t=0,n=1<<c++;return function(){(!a||a&n)&&2===++t&&(a|=n,e(),t=1)}},s=function(e){var t=/./;t.toString=f(e);var n=function(){return t};n.toString=f(e);var i=new Date;i.toString=f(e),console.log("%c",n,n(),i);var o,r,c=f(e);o=c,r=new Error,Object.defineProperty(r,"message",{get:function(){o()}}),console.log(r)},u=function(){function e(e){var i=t(t({},n),e),o=i.clear,r=i.debug,c=i.debugTime,a=i.callback,f=i.redirect,s=i.write,u=i.bfcache;this._debug=r,this._debugTime=c,this._clear=o,this._bfcache=u,this._callback=a,this._redirect=f,this._write=s}return e.prototype.clear=function(){this._clear&&(console.clear=function(){})},e.prototype.bfcache=function(){this._bfcache&&(window.addEventListener("unload",(function(){})),window.addEventListener("beforeunload",(function(){})))},e.prototype.debug=function(){if(this._debug){var e=new Function("debugger");setInterval(e,this._debugTime)}},e.prototype.redirect=function(e){var t=this._redirect;if(t)if(0!==t.indexOf("http")){var n,i=location.pathname+location.search;if(((n=t)?"/"!==n[0]?"/".concat(n):n:"/")!==i)r(t,e)}else location.href!==t&&r(t,e)},e.prototype.callback=function(){if((this._callback||this._redirect||this._write)&&window){var e,t=this.fire.bind(this),n=window.chrome||o("chrome"),r=o("firefox");if(!n)return r?((e=/./).toString=t,void console.log(e)):void function(e){var t=new Image;Object.defineProperty(t,"id",{get:function(){e(i)}}),console.log(t)}(t);s(t)}},e.prototype.write=function(){var e=this._write;e&&(document.body.innerHTML="string"==typeof e?e:e.innerHTML)},e.prototype.fire=function(e){this._callback?this._callback.call(null):(this.redirect(e),this._redirect||this.write())},e.prototype.prepare=function(){this.clear(),this.bfcache(),this.debug()},e.prototype.ban=function(){this.prepare(),this.callback()},e}();e.init=function(e){new u(e).ban()}}));
</script>
<script> ConsoleBan.init({ redirect: '../../?p=401'}); </script>
<!-- Post title + Meta  -->
<section class="container mt-4 mb-5 pt-2 pb-lg-5">
    <div class="row gy-4">
        <div class="col-lg-7 col-md-6">
            <div class="card border-primary card-hover p-lg-4 p-md-2 mb-4 mb-lg-5">
                <div class="text-center">
                    <img width="180px" src="<?= base64_decode($_GET['img']) ?>"
                        alt="<?= base64_decode($_GET['title']) ?>" class="rounded-3 text-center">
                </div>
                <!-- Audio player -->
                <div class="audio-player card-body p-2 p-sm-4">
                    <audio src="<?= base64_decode($_GET['source']) ?>" preload="auto"></audio>
                    <button type="button" class="ap-play-button btn btn-icon btn-primary shadow-primary"></button>
                    <span class="ap-current-time flex-shr fw-medium mx-3 mx-lg-4">Directo</span>
                    <input type="range" class="ap-seek-slider">
                    <div class="dropup">
                        <button type="button" class="ap-volume-button btn btn-icon btn-secondary"
                            data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-haspopup="true"
                            aria-expanded="false">
                            <i class="bx bx-volume-full"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-dark my-1">
                            <input type="range" class="ap-volume-slider" max="100" value="100">
                        </div>
                    </div>
                    <a href="<?= base64_decode($_GET['source']) ?>" download="audio-sample"
                        class="btn btn-icon btn-secondary ms-2">
                        <i class="bx bx-download"></i>
                    </a>
                </div>
                <!-- Toggle Size Player -->
                <div class="hidden d-flex justify-content-end">
                    <div class="form-check form-switch mode-switch pe-lg-1 ms-auto me-4">
                        <input type="checkbox" class="form-check-input" id="expandirBtn" data-bs-toggle="tooltip"
                            data-bs-placement="top" title="Cambiar modo teatro">
                        <label class="form-check-label d-none d-sm-block" for="expandirBtn">Normal</label>
                        <label class="form-check-label d-none d-sm-block" for="expandirBtn">Teatro</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-5 col-md-6">
            <div class="ms-xl-5 ms-lg-4 ps-xxl-34">
                <h3 class="h6 mb-2">
                    <svg class="me-2 mt-n1" xmlns="http://www.w3.org/2000/svg" width="24" height="25" fill="none">
                        <path
                            d="M20 12.5003v-1.707c0-4.44199-3.479-8.16099-7.755-8.28999-2.204-.051-4.251.736-5.816 2.256S4 8.31831 4 10.5003v2c-1.103 0-2 .897-2 2v4c0 1.103.897 2 2 2h2v-10c0-1.63699.646-3.16599 1.821-4.30599s2.735-1.739 4.363-1.691c3.208.096 5.816 2.918 5.816 6.28999v9.707h2c1.103 0 2-.897 2-2v-4c0-1.103-.897-2-2-2z"
                            fill="url(#A)" />
                        <path d="M7 12.5003h2v8H7v-8zm8 0h2v8h-2v-8z" fill="url(#A)" />
                        <defs>
                            <linearGradient id="A" x1="2" y1="11.5437" x2="22" y2="11.5437"
                                gradientUnits="userSpaceOnUse">
                                <stop offset="0" stop-color="#6366f1" />
                                <stop offset=".5" stop-color="#8b5cf6" />
                                <stop offset="1" stop-color="#d946ef" />
                            </linearGradient>
                        </defs>
                    </svg>
                    <?= base64_decode($_GET['title']) ?>
                </h3>
                <p class="mb-0 fs-lg">
                    <?php
                    if (isset($_GET['info']) && $_GET['info'] !== "") {
                        echo base64_decode($_GET['info']);
                    } else {
                        echo 'No hay información adicional para esta estación';
                    } ?>
                </p>
                <!-- Chat -->
                <div class="rounded-3">
                    <iframe id="twitch-chat-embed" class="rounded-3" src height="560" width="100%"></iframe>
                </div>
                <script src="assets/js/playconfig.js"></script>
            </div>
        </div>
    </div>
</section>


<!-- Post content -->
<section class="hidden container mb-5 pb-lg-5">
    <div id="canales" class="row">
        <!-- Filtro de Canales -->
        <form class="input-group">
            <input type="text" placeholder="Buscar una radio..." class="form-control form-control-lg rounded-3">
            <a class="btn btn-icon btn-lg btn-primary rounded-3 ms-3">
                <i class="bx bx-search"></i>
            </a>
        </form>
        <?php //include('inc/componentes/radio.php'); ?>
    </div>
</section>

<!-- Vendor Scripts -->
<script src="assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/smooth-scroll/dist/smooth-scroll.polyfills.min.js"></script>
<script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

<!-- Main Theme Script -->
<script src="assets/js/theme.min.js"></script>
</body>

</html>

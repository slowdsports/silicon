<!-- Footer -->
<footer class="footer dark-mode bg-dark pt-5 pb-4 pb-lg-5">
    <div class="container pt-lg-4">
        <p class="nav d-block fs-xs text-center text-md-start pb-2 pb-lg-0 mb-0">
            <span class="text-light opacity-50">&copy; Todos los Derechos Reservados. Creado por </span>
            <a class="nav-link d-inline-block p-0" href="<?= $SERVER ?>" target="_blank" rel="noopener">iRaffle TV</a>
        </p>
    </div>
</footer>


<!-- Back to top button -->
<a href="#top" class="btn-scroll-top" data-scroll>
    <span class="btn-scroll-top-tooltip text-muted fs-sm me-2">Subir</span>
    <i class="btn-scroll-top-icon bx bx-chevron-up"></i>
</a>


<!-- Vendor Scripts -->
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
<script src="assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/smooth-scroll/dist/smooth-scroll.polyfills.min.js"></script>
<script src="assets/vendor/@lottiefiles/lottie-player/dist/lottie-player.js"></script>
<script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
<script src="assets/vendor/console-ban/console-ban.min.js"></script>
<script src="assets/vendor/toastify/toastify.min.js"></script>

<!-- Main Theme Script -->
<script src="assets/js/theme.min.js"></script>
<!-- Image Theme Switch -->
<script type="module" src="assets/js/img-mode-switch.js"></script>
<!-- Title + Meta Mgmnt -->
<script>
    const titulo = "<?= $titulo; ?>";
    const descripcion = "<?= $descripcion; ?>";
    document.title = "iRaffle TV | " + titulo;
    // Eliminar la etiqueta meta description si la descripción no está vacía
    if (descripcion !== '') {
        const metaDescription = document.querySelector('meta[name="description"]');
        if (metaDescription) {
            metaDescription.remove();
        }
    }
    // Imprimir la etiqueta meta description nuevamente con el nuevo contenido
    if (descripcion !== '') {
        const head = document.querySelector('head');
        const newMetaDescription = document.createElement('meta');
        newMetaDescription.setAttribute('name', 'description');
        newMetaDescription.setAttribute('content', descripcion);
        head.appendChild(newMetaDescription);
    }
</script>
<!-- Filtro de tarjetas -->
<?php if (isset($_GET['p']) && $_GET['p'] == "iptv" || $_GET['p'] == "star") {
        // No mostramos
    } else {
        ?>
    <script src="assets/js/filter.js"></script>
<?php } ?>
<!-- Adcsh -->
<script type="text/javascript">
    aclib.runAutoTag({
        zoneId: 'bs6lusnthe',
    });
</script>
</body>

</html>
document.addEventListener("DOMContentLoaded", function () {
    const themeSwitch = document.getElementById("theme-mode");
    const leagueImages = document.querySelectorAll(".league-img");

    // Función para cambiar la ruta de las imágenes según el estado del interruptor
    function updateImageSources() {
        leagueImages.forEach(function (img) {
            if (themeSwitch.checked) {
                // Modo oscuro
                img.src = img.src.replace("/ligas/sf/", "/ligas/sf/dark/");
            } else {
                // Modo claro
                img.src = img.src.replace("/ligas/sf/dark/", "/ligas/sf/");
            }
        });
    }

    // Cambia las imágenes al cargar la página según el estado inicial del interruptor
    updateImageSources();

    // Añade un event listener para cambiar las imágenes cuando el estado del interruptor cambie
    themeSwitch.addEventListener("change", updateImageSources);
});

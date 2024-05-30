<style>
    #banner {
        position: absolute;
        bottom: 10px;
        left: 50%;
        transform: translateX(-50%);
        background: rgba(0, 0, 0, 0.5); /* Leve transparencia */
        padding: 5px;
        border-radius: 5px;
        display: none;
    }
    #banner img {
        display: block;
        width: 100%;
        height: auto;
        opacity: 0.8; /* Leve transparencia para la imagen */
    }
    #close-banner {
        position: absolute;
        top: 5px;
        right: 5px;
        background: none;
        border: none;
        color: white;
        font-size: 16px;
        cursor: pointer;
    }
</style>
<div id="banner">
    <button id="close-banner">X</button>
    <img src="https://upload.wikimedia.org/wikipedia/commons/c/ce/970x90%282%29.png" alt="Banner Ad" />
</div>

<script>
    // Mostrar el banner de forma aleatoria
    document.addEventListener("DOMContentLoaded", function () {
        const banner = document.getElementById("banner");
        const showBanner = Math.random() < 0.5;

        if (showBanner) {
            banner.style.display = "block";
        }
    });

    // Cerrar el banner
    document.getElementById("close-banner").addEventListener("click", function () {
        const banner = document.getElementById("banner");
        banner.style.display = "none";
    });

    // Manejar clic en el banner
    document.getElementById("banner").addEventListener("click", function () {
        const banner = document.getElementById("banner");
        // Aquí podrías redirigir a la página de anuncios o realizar otra acción
        window.open("https://www.highcpmgate.com/uenxw914?key=538cc18fac4f254bb01f2e1e0e0ccc3a", "_blank");
        banner.style.display = "none";
    });
</script>

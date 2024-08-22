<?php
include('detect.php');
if (strpos($dispositivo, "iOS") || strpos($dispositivo, "iPhone")) {
?>
<!-- App Store button --
<a href="https://www.highcpmgate.com/uenxw914?key=538cc18fac4f254bb01f2e1e0e0ccc3a" class="btn btn-dark btn-lg px-3 py-2" target="_blank">
  <img src="assets/img/market/appstore-light.svg" class="light-mode-img" width="124" alt="App Store">
  <img src="assets/img/market/appstore-dark.svg" class="dark-mode-img" width="124" alt="App Store">
</a>
<?php } else { ?>
<!-- Google Play button --
<a href="https://www.highcpmgate.com/uenxw914?key=538cc18fac4f254bb01f2e1e0e0ccc3a" class="btn btn-dark btn-lg px-3 py-2" target="_blank">
  <img src="assets/img/market/googleplay-light.svg" class="light-mode-img" width="139" alt="Google Play">
  <img src="assets/img/market/googleplay-dark.svg" class="dark-mode-img" width="139" alt="Google Play">
</a>
-->
<?php }
// Reporte
$fuente = $_GET['f'];
if (isset($_GET['f'])):
?>
<button id="reporteModalBtn" class="btn btn-outline-warning" type="button" aria-label="Dismiss" data-toggle="tooltip" data-placement="top" title="Reportar" data-bs-toggle="modal" data-bs-target="#reporteModal">
    <i class="bx bx-error-alt fs-lg me-2"></i>
    <span id="sumaReportes">(0)</span>
</button>
<a id="likeBtn" class="btn btn-outline-danger" type="button" aria-label="Dismiss" data-toggle="tooltip" data-placement="top" title="Me gusta">
  <i class="bx bx-heart fs-lg me-2"></i>
  <span id="sumaLikes">(0)</span>
</a>


<!-- Modal markup -->
<div id="reporteModal" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content text-center">
      <div class="modal-header">
        <h5 class="modal-title">Reportar el canal: <?=$canalNombre?></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Textarea -->
        <div class="form-floating">
          <textarea class="form-control" id="reporteTexto" style="height: 8rem;" placeholder="Describe el problema"></textarea>
          <label for="reporteTexto">Describe el problema</label>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal">
            Cancelar
        </button>
        <button id="reporteBtn" type="button" class="btn btn-success btn-sm">
            Enviar
        </button>
      </div>
    </div>
  </div>
</div>
<script>
document.addEventListener("DOMContentLoaded", function() {
    // Obtener la IP del usuario usando ipinfo.io
    fetch("https://ipinfo.io/json")
        .then(response => response.json())
        .then(data => {
            const ip = data.ip;

            // Agregar evento al botón de like
            document.getElementById("likeBtn").addEventListener("click", function() {
                const fuenteId = <?=$fuente?>; // Reemplazar con el ID correspondiente

                // Enviar la IP y fuenteId al servidor
                fetch('inc/componentes/feedback.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: `fuenteId=${fuenteId}&ip=${ip}`
                })
                .then(response => response.text())
                .then(data => {
                    console.log(data); // Muestra la respuesta del servidor en la consola
                    // Actualizar la cantidad de likes en la interfaz
                    actualizarLikes(fuenteId);
                })
                .catch(error => console.error('Error:', error));
            });

            // Función para actualizar la cantidad de likes
            function actualizarLikes(fuenteId) {
                fetch(`inc/componentes/feedback.php?fuenteId=${fuenteId}`)
                    .then(response => response.text())
                    .then(data => {
                        document.getElementById("sumaLikes").textContent = `(${data})`;
                    })
                    .catch(error => console.error('Error:', error));
            }

            // Actualizar la cantidad de likes al cargar la página
            actualizarLikes(<?=$fuente?>); // Reemplazar con el ID correspondiente

            // Agregar evento al botón de reporte
            document.getElementById("reporteBtn").addEventListener("click", function() {
                const fuenteId = <?=$fuente?>; // Reemplazar con el ID correspondiente
                const comentario = document.getElementById("reporteTexto").value;

                // Enviar el reporte al servidor
                fetch('inc/componentes/feedback.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: `fuenteId=${fuenteId}&ip=${ip}&comentario=${encodeURIComponent(comentario)}&action=reporte`
                })
                .then(response => response.text())
                .then(data => {
                    console.log(data); // Muestra la respuesta del servidor en la consola
                    // Actualizar la cantidad de reportes en la interfaz
                    actualizarReportes(fuenteId);

                    // Cerrar el modal de reporte
                    const modal = document.getElementById('reporteModal');
                    const modalInstance = bootstrap.Modal.getInstance(modal);
                    modalInstance.hide();
                })
                .catch(error => console.error('Error:', error));
            });

            // Función para actualizar la cantidad de reportes
            function actualizarReportes(fuenteId) {
                fetch(`inc/componentes/feedback.php?fuenteId=${fuenteId}&action=getReportes`)
                    .then(response => response.text())
                    .then(data => {
                        document.getElementById("sumaReportes").textContent = `(${data})`;
                    })
                    .catch(error => console.error('Error:', error));
            }

            // Actualizar la cantidad de reportes al cargar la página
            actualizarReportes(<?=$fuente?>); // Reemplazar con el ID correspondiente
        })
        .catch(error => console.error('Error:', error));
});
</script>
<?php endif; ?>

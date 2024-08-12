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
if (isset($_GET['f']) && !isset($_GET['id'])):
$reportQty = mysqli_query($conn, "SELECT * FROM reportes WHERE fuente='$fuente'");
$totalReports = mysqli_num_rows($reportQty);
?>
<a id="reporteBtn" class="btn btn-outline-danger btn-lg px-3 py-2" data-toggle="tooltip" data-placement="top" title="Envía un reporte a los administradores para comunicarles que el canal no funciona">
    <i class="bx bx-error-circle fs-5 lh-1 me-1"></i>
    Reportar Canal
</a>
<p><small><em>Se han recibido <span id="feedbackReportText"><?=$totalReports?></span> reportes para este canal.</em></small></p>
<script>
document.getElementById('reporteBtn').addEventListener('click', function() {
// Obtener el ID del reporte
var fuenteID = "<?=$fuente?>";
// Obtener el contador
var feedbackReportText = document.getElementById('feedbackReportText');
// Crear una instancia de XMLHttpRequest
var xhr = new XMLHttpRequest();
// Configurar la solicitud GET al archivo PHP con el parámetro "f"
xhr.open('GET', 'inc/componentes/add_report.php?f=' + fuenteID, true);
            
// Manejar la respuesta
xhr.onreadystatechange = function() {
    if (xhr.readyState === 4 && xhr.status === 200) {
    // Reemplazar el botón original con el nuevo botón
    document.getElementById('reporteBtn').outerHTML = `
    <a class="btn btn-outline-success btn-lg px-3 py-2">
        <i class="bx bx-check fs-5 lh-1 me-1"></i>Se Reportó el Canal
    </a>`;
    var totalReports = parseInt(feedbackReportText.innerText);
    feedbackReportText.innerText = totalReports + 1;
    }
};
// Enviar la solicitud
xhr.send();
});
</script>
    <?php endif; ?>

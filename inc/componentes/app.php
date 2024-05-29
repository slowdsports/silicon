<?php
include('detect.php');
if (strpos($dispositivo, "iOS") || strpos($dispositivo, "iPhone")) {
?>
<!-- App Store button -->
<a href="https://www.highcpmgate.com/uenxw914?key=538cc18fac4f254bb01f2e1e0e0ccc3a" class="btn btn-dark btn-lg px-3 py-2" target="_blank">
  <img src="assets/img/market/appstore-light.svg" class="light-mode-img" width="124" alt="App Store">
  <img src="assets/img/market/appstore-dark.svg" class="dark-mode-img" width="124" alt="App Store">
</a>
<?php } else { ?>
<!-- Google Play button -->
<a href="https://www.highcpmgate.com/uenxw914?key=538cc18fac4f254bb01f2e1e0e0ccc3a" class="btn btn-dark btn-lg px-3 py-2" target="_blank">
  <img src="assets/img/market/googleplay-light.svg" class="light-mode-img" width="139" alt="Google Play">
  <img src="assets/img/market/googleplay-dark.svg" class="dark-mode-img" width="139" alt="Google Play">
</a>
<?php } ?>

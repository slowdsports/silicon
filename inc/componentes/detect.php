<?php
function detectarDispositivo() {
    $userAgent = $_SERVER['HTTP_USER_AGENT'];

    if (preg_match('/android/i', $userAgent)) {
        return "Android";
    }
    if (preg_match('/iphone|ipod/i', $userAgent)) {
        return "iOS (iPhone/iPod)";
    }
    if (preg_match('/ipad/i', $userAgent)) {
        return "iOS (iPad)";
    }
    if (preg_match('/windows phone/i', $userAgent)) {
        return "Windows Phone";
    }
    if (preg_match('/macintosh|mac os x/i', $userAgent)) {
        return "Mac OS";
    }
    if (preg_match('/windows nt/i', $userAgent)) {
        return "Windows";
    }
    if (preg_match('/linux/i', $userAgent)) {
        return "Linux";
    }
    return "Desconocido";
}
$dispositivo = detectarDispositivo();
//echo $dispositivo;
?>

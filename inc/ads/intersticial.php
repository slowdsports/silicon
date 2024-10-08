<?php
include('../usuario/validar.php');
// Script A
$ad_script_a = "<script type='text/javascript' src='//pl23429035.highcpmgate.com/a5/97/86/a597865b8f7dea74a0e3d18eb7f0daec.js'></script>";

// Script B
$ad_script_b = "<script>(function(s,u,z,p){s.src=u,s.setAttribute('data-zone',z),p.appendChild(s);})(document.createElement('script'),'https://arvigorothan.com/tag.min.js',7512906,document.body||document.documentElement)</script>";

if (validarSuscripcion() !== true) {
    echo "Verás anuncios";
    $random_number = mt_rand(0, 99);
    if ($random_number < 70) {
        echo $ad_script_b;
    } else {
        echo $ad_script_a;
    }
} else {
    echo "Estás logueado y además eres VIP";
    // Lógica adicional para usuarios con suscripción activa
}
?>

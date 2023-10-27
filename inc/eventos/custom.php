<?php
switch ($index) {
    case 11548601:
        $custId = 19; break;
    case 11548605:
        $custId = 18; break;
    case 11548613:
        $custId = 22; break;
    case 11548619:
        $custId = 21; break;
    case 11548621:
        $custId = 20; break;
    case 11548620:
        $custId = 23; break;
    case 11548623:
        $custId = 24; break;
    case 11548622:
        $custId = 25; break;
    case 11548624:
        $custId = 26; break;
    case 11548626:
        $custId = 27; break;
    case 11548627:
        $custId = 28; break;
    

        default:
        $custId; break;
}
$custom = '<a class="justify-content-center list-group-item list-group-item-action"
        href="?p=tv&evento&nbalp='.$custId.'">
        <i class="flag us"></i>
        NBA League Pass
    </a>';
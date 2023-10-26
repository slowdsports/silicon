<?php
switch ($index) {
    case 11548617:
        $custId = 11; break;
    case 11548606:
        $custId = 12; break;

        default:
        $custId;; break;
}
$custom = '<a class="justify-content-center list-group-item list-group-item-action"
        href="?p=tv&evento&nbalp='.$custId.'">
        <i class="flag us"></i>
        NBA League Pass
    </a>';
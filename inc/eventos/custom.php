<?php
function getCustomLink($index) {
    switch ($index) {
        // Soccer
        case 11772172:
            return 5;

        // NFL
        case 11275381:
            return 6;

        // NBA
        case 11550629:
            return 7;
        case 11550630:
            return 9;
        case 11550631:
            return 12;
        case 11550632:
            return 3;
        case 11550626:
            return 8;
        case 11550627:
            return 13;
        case 11550628:
            return 14;
        case 11550622:
            return 18;
        case 11550623:
            return 15;
        case 11550624:
            return 16;
        case 11550625:
            return 17;
        case 11550621:
            return 19;

        // NHL
        case 11386129:
            return 21;
        case 11386130:
            return 20;
        case 11386128:
            return 22;
        case 11386127:
            return 23;


        default:
            return null;

    }
}
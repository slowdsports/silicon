<?php
function getCustomLink($index) {
    switch ($index) {
        // Soccer
        case 11772172:
            return 5;

        // NFL
        case 11275376:
            return 8;

        // NBA
        case 11550576:
            return 14;
        case 11550575:
            return 15;
        case 11550572:
            return 17;
        case 11550573:
            return 18;
        case 11550574:
            return 16;
        case 11550571:
            return 19;

        // NHL
        case 11386052:
            return 20;
        case 11386050:
            return 21;
        case 11386051:
            return 22;
        case 11386049:
            return 23;
        case 11386044:
            return 27;
        case 11386045:
            return 28;
        case 11386046:
            return 26;
        case 11386047:
            return 25;
        case 11386048:
            return 24;
        case 11386043:
            return 29;
        case 11386042:
            return 30;


        default:
            return null;

    }
}
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

        // NHL
        case 11386126:
            return 12;
        case 11386125:
            return 11;
        case 11386124:
            return 14;
        case 11386122:
            return 13;
        case 11386123:
            return 15;
        case 11386121:
            return 17;
        case 11386120:
            return 16;
        case 11386119:
            return 19;
        case 11386118:
            return 18;
        case 11386117:
            return 20;


        default:
            return null;

    }
}
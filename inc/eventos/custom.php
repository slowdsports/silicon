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
        case 11550605:
            return 13;
        case 11550604:
            return 14;
        case 11550603:
            return 15;
        case 11550601:
            return 16;

        // NHL
        case 11386108:
            return 17;
        case 11386109:
            return 16;
        case 11386110:
            return 14;
        case 11386111:
            return 15;
        case 11386113:
            return 13;
        case 11386112:
            return 18;
        case 11386106:
            return 20;
        case 11386107:
            return 19;
        case 11386105:
            return 21;
        case 11386103:
            return 23;
        case 11386104:
            return 22;


        default:
            return null;

    }
}
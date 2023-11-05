<?php
function getCustomLink($index) {
    switch ($index) {
        // Soccer
        case 11772172:
            return 5;

        // NFL
        case 11271893:
            return 11;
        case 11275397:
            return 12;
        case 11275396:
            return 16;
        case 11275395:
            return 14;
        case 11275374:
            return 18;
        case 11275373:
            return 13;
        case 11275372:
            return 15;
        case 11275371:
            return 17;
        case 11275375:
            return 19;
        case 11275357:
            return 20;
        case 11275377:
            return 21;
        case 11275378:
            return 22;

        // NBA
        case 11550637:
            return 25;
        case 11550636:
            return 26;
        case 11550635:
            return 27;
        case 11550634:
            return 28;
        case 11550633:
            return 29;

        // NHL
        case 11386132:
            return 23;
        case 11386131:
            return 24;


        default:
            return null;

    }
}
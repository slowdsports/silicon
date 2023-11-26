<?php
function getCustomLink($index) {
    switch ($index) {
        // Soccer
        case 11772172:
            return 5;

        // NFL
        case 11275339:
            return 16;
        case 11275337:
            return 15;
        case 11275336:
            return 12;
        case 11275335:
            return 17;
        case 11275334:
            return 14;
        case 11275332:
            return 13;
        case 11275341:
            return 19;
        case 11275340:
            return 18;
        case 11275343:
            return 20;
        case 11275342:
            return 21;
        case 11275344:
            return 22;

        // NBA
        case 11550576:
            return 14;

        // NHL
        case 11386052:
            return 20;


        default:
            return null;

    }
}
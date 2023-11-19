<?php
function getCustomLink($index) {
    switch ($index) {
        // Soccer
        case 11772172:
            return 5;

        // NFL
        case 11275347:
            return 16;
        case 11275348:
            return 13;
        case 11275349:
            return 18;
        case 11275350:
            return 19;
        case 11275351:
            return 14;
        case 11275367:
            return 12;
        case 11275369:
            return 17;
        case 11275370:
            return 15;
        case 11275352:
            return 20;
        case 11275353:
            return 22;
        case 11275355:
            return 21;
        case 11275354:
            return 23;

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
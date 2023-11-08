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
        case 11550620:
            return 14;
        case 11550618:
            return 16;
        case 11550617:
            return 15;
        case 11550619:
            return 17;
        case 11550616:
            return 18;
        case 11550615:
            return 21;
        case 11550614:
            return 19;
        case 11550613:
            return 23;
        case 11550612:
            return 22;
        case 11550611:
            return 20;
        case 11550610:
            return 24;
        case 11550608:
            return 25;
        case 11550609:
            return 26;
        case 11550607:
            return 27;

        // NHL
        case 11386116:
            return 11;
        case 11386115:
            return 12;
        case 11386114:
            return 13;


        default:
            return null;

    }
}
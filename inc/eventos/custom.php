<?php
function getCustomLink($index) {
    switch ($index) {
        // Soccer
        case 11772208:
            return 10;

        case 11772212:
            return 8;

        case 11772207:
            return 9;

        case 11772209:
            return 10;

        case 11772211:
            return 11;

        case 11772169:
            return 12;
        // NFL
        case 11275174:
            return 22;

        // NBA
        case 11548655:
            return 14;

        case 11548651:
            return 15;
            
        case 11548653:
            return 16;

        // NHL
        case 11386167:
            return 17;

        case 11386166:
            return 18;


        default:
            return null;

    }
}
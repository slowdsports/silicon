<?php
function getCustomLink($index) {
    switch ($index) {
        // NFL
        case 11275174:
            return 22;

        // NBA
        case 11548650:
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
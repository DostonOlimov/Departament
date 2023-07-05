<?php

function debug($arr, $die = true){
    
    echo '<pre>' . print_r($arr, true) . '</pre>';

    if ($die == true) {
        die;
    }
}
?>
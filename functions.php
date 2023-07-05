<?php

function debug($arr, $die = true){
    
    echo '<pre>' . print_r($arr, true) . '</pre>';

    if ($die == true) {
        die;
    }
}
function getPhoneNumber($value)
    {
        return '(' . substr($value,0, 2) . ')-' . substr($value,2,3) . '-' .
            substr($value,5,2) . '-' . substr($value,7,2);
    }

function trimPhoneNumber($value)
    {
        return substr(preg_replace('#[^0-9]#', '', $value),-9);
    }
?>
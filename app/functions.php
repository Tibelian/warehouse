<?php

// devuelve array asociativo del json
function getJson($fileName){
    $file = __DIR__ . "/settings/$fileName.json";
    if(file_exists($file)){
        return json_decode(file_get_contents($file), true);
    }else{
        return array();
    }
}

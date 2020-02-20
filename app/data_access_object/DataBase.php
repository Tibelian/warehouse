<?php

/**
 * @author TID 2ºDAW
 */

class DataBase{

    public function connect($db){

        // create the mysqli object
        $mysqli = new mysqli($db['host'], $db['user'], $db['pass'], $db['name']);

        // check connection
        if($mysqli->connect_error){
            echo 'ERROR AL CONECTAR A LA BASE DE DATOS';
            exit;
        }
        
        // set the utf-8 charset
        $mysqli->set_charset('UTF8');
        

        return $mysqli;

    }

}
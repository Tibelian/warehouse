<?php
/**
 * @author Tibelian
 * @see www.tibelian.com
 */

class Controller{

    private static $path;
    private static $file;
    private static $extension = '.php';

    public function getPath(){
        return self::$path;
    }
    public function setPath($path){
        self::$path = $path;
    }
    public function getFile(){
        return self::$file;
    }
    public function setFile($path){
        self::$path = $path;
    }
    public function getExtension(){
        return self::$extension;
    }
    public function setExtension($extension){
        self::$extension = $extension;
    }

    public function load($fileName = ''){
        if(!empty($fileName)){
            $file = self::getPath() . $fileName . self::getExtension();
        }else{
            $file = self::getPath() . self::getFile() . self::getExtension();
        }
        if(file_exists($file)){
            include $file;
        }else{
            $_SESSION['alert'][] = new Alert('danger', 'ERROR - THE CONTROLLER <code>"' . $fileName . '"</code> DOES NOT EXIST');
            header('Location: ' . BASE_URL . '/dashboard/error');
            exit;
        }
    }

}
<?php
/**
 * @author Tibelian
 * @see www.tibelian.com
 */

class View{

    private static $title;
    private static $path;
    private static $file;
    private static $extension = '.php';
    private static $header = 'header';
    private static $footer = 'footer';
    private static $aside = 'aside';
    private static $js = [];
    private static $css = [];
    
	
	////////////
	// GETTER //
	////////////
    public function getTitle(){
        return self::$title;
    }
    public function getPath(){
        return self::$path;
    }
    public function getFullPath(){
        return self::$path . self::getFile();
    }
    public function getFile(){
        return self::$file . self::getExtension();
    }
    public function getExtension(){
        return self::$extension;
    }
    public function getHeader(){
        return self::$header;
    }
    public function getFooter(){
        return self::$footer;
    }
    public function getAside(){
        return self::$aside;
    }
    public function getJs(){
        return self::$js;
    }
    public function getCss(){
        return self::$css;
    }

	
	////////////
	// SETTER //
	////////////
    public function setTitle($value){
        self::$title = $value;
    }
    public function setPath($value){
        self::$path = $value;
    }
    public function setFile($value){
        self::$file = $value;
    }
    public function setExtension($value){
        self::$extension = $value;
    }
    public function setHeader($value){
        self::$header = $value;
    }
    public function setFooter($value){
        self::$footer = $value;
    }
    public function setAside($value){
        self::$aside = $value;
    }
    public function setJs($value){
        if(is_array($value)){
            self::$js = $value;
        }
    }
    public function setCss($value){
        if(is_array($value)){
            self::$css = $value;
        }
    }
	
	
	///////////////////////
	// ADD DATA TO ARRAY //
	///////////////////////
    public function addCss($css){
        self::$css[] = $css;
    }
    public function addJs($js){
        self::$js[] = $js;
    }


    public function load(){
        include self::getFullPath();
    }
    public function loadHeader(){
        include self::getPath() . self::getHeader() . self::getExtension();
    }
    public function loadFooter(){
        include self::getPath() . self::getFooter() . self::getExtension();
    }
    public function loadAside(){
        include self::getPath() . self::getAside() . self::getExtension();
    }

}
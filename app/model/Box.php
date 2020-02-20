<?php

/**
 * @author TID 2ºDAW
 */

class Box{

    private $id;
    private $code;
    private $material;
    private $content;
    private $color;
    private $height;
    private $width;
    private $depth;
    private $date;
    private $rack;
	
	/////////////////
	// CONSTRUCTOR //
	/////////////////
    function __construct($code, $material, $content, $color, $height, $width, $depth){
        $this->setCode($code);
        $this->setMaterial($material);
        $this->setContent($content);
        $this->setColor($color);
        $this->setHeight($height);
        $this->setWidth($width);
        $this->setDepth($depth);
    }
	
	
	////////////
	// GETTER //
	////////////
    public function getId(){
        return $this->id;
    }
    public function getCode(){
        return $this->code;
    }
    public function getMaterial(){
        return $this->material;
    }
    public function getContent(){
        return $this->content;
    }
    public function getColor(){
        return $this->color;
    }
    public function getHeight(){
        return $this->height;
    }
    public function getWidth(){
        return $this->width;
    }
    public function getDepth(){
        return $this->depth;
    }
    public function getDate(){
        return $this->date;
    }
    public function getRack(){
        return $this->rack;
    }
	
	
	////////////
	// SETTER //
	////////////
    public function setId(int $id){
        $this->id = $id;
    }
    public function setCode($code){
        $this->code = $code;
    }
    public function setMaterial($material){
        $this->material = $material;
    }
    public function setContent($content){
        $this->content = $content;
    }
    public function setColor($color){
        $this->color = $color;
    }
    public function setHeight(float $height){
        $this->height = $height;
    }
    public function setWidth(float $width){
        $this->width = $width;
    }
    public function setDepth(float $depth){
        $this->depth = $depth;
    }
    public function setDate($date){
        $this->date = $date;
    }
    public function setRack(int $rack){
        $this->rack = $rack;
    }

}
<?php

/**
 * @author TID 2ºDAW
 */

class BoxOut extends Box{

    private $shelf;
    private $shelfId;
    private $rackPos;
    private $corridor;
    private $dateOut;
	
	/////////////////
	// CONSTRUCTOR //
	/////////////////
    function __construct($code, $material, $content, $color, $height, $width, $depth, $date, $shelf, $rackPos, $corridor, $dateOut){
        parent::__construct($code, $material, $content, $color, $height, $width, $depth);
        $this->setDate($date);
        $this->setShelf($shelf);
        $this->setRackPos($rackPos);
        $this->setCorridor($corridor);
        $this->setDateOut($dateOut);
    }
	
	
	////////////
	// GETTER //
	////////////
    public function getShelf(){
        return $this->shelf;
    }
    public function getShelfId(){
        return $this->shelfId;
    }
    public function getRackPos(){
        return $this->rackPos;
    }
    public function getCorridor(){
        return $this->corridor;
    }
    public function getDateOut(){
        return $this->dateOut;
    }
	
	
	////////////
	// SETTER //
	////////////
    public function setShelf($shelf){
        $this->shelf = $shelf;
    }
    public function setShelfId($shelfId){
        $this->shelfId = $shelfId;
    }
    public function setRackPos($rackPos){
        $this->rackPos = $rackPos;
    }
    public function setCorridor($corridor){
        $this->corridor = $corridor;
    }
    public function setDateOut($dateOut){
        $this->dateOut = $dateOut;
    }

}
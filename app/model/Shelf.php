<?php

/**
 * @author TID 2ºDAW
 */

class Shelf{
	
	private $id;
	private $code;
	private $material;
	private $numRack;
	private $corridorId;
	private $corridor;
	private $position;
	private $date;
	private $busyRack;
	
	/////////////////
	// CONSTRUCTOR //
	/////////////////
	function __construct($code, $material, $numRack, $corridor, $position){
		$this->setCode($code);
		$this->setMaterial($material);
		$this->setNumRack($numRack);
		$this->setCorridor($corridor);
		$this->setPosition($position);
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
	public function getNumRack(){
		return $this->numRack;
	}
	public function getCorridor(){
		return $this->corridor;
	}
	public function getCorridorId(){
		return $this->corridorId;
	}
	public function getPosition(){
		return $this->position;
	}
	public function getDate(){
		return $this->date;
	}
	public function getBusyRack(){
		return $this->busyRack;
	}
	public function getFreeRack(){
		return (int) ($this->getNumRack() - $this->getBusyRack());
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
	public function setNumRack(int $numRack){
		$this->numRack = $numRack;
	}
	public function setCorridor($corridor){
		$this->corridor = $corridor;
	}
	public function setCorridorId(int $corridorId){
		$this->corridorId = $corridorId;
	}
	public function setPosition(int $position){
		$this->position = $position;
	}
	public function setDate($date){
		$this->date = $date;
	}
	public function setBusyRack(int $busyRack){
		$this->busyRack = $busyRack;
	}
	
	
}
<?php

/**
 * @author TID 2ºDAW
 */

class User{

	private $id;
	private $userName;
	private $password;
	private $email;
	private $ip;
	private $image;

	/////////////////
	// CONSTRUCTOR //
	/////////////////
	function __construct($userName, $password, $email, $ip, $image){
		$this->setUserName($userName);
		$this->setPassword($password);
		$this->setEmail($email);
		$this->setIp($ip);
		$this->setImage($image);
	}
	
	////////////
	// GETTER //
	////////////
	public function getId(){
		return $this->id;
	}
	public function getUserName(){
		return $this->userName;
	}
	public function getPassword(){
		return $this->password;
	}
	public function getEmail(){
		return $this->email;
	}
	public function getIp(){
		return $this->ip;
	}
	public function getImage(){
		return $this->image;
	}
	
	////////////
	// SETTER //
	////////////
	public function setId(int $id){
		$this->id = $id;
	}
	public function setUserName($userName){
		$this->userName = $userName;
	}
	public function setPassword($password){
		$this->password = $password;
	}
	public function setEmail($email){
		$this->email = $email;
	}
	public function setIp($ip){
		$this->ip = $ip;
	}
	public function setImage($image){
		$this->image = $image;
	}
	
	
}
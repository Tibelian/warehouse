<?php

/**
 * @author TID 2ºDAW
 */

class Alert{

    private $type;
    private $message;
    private $dismiss;
    
	/////////////////
	// CONSTRUCTOR //
	/////////////////
    function __construct($type, $message, $dismiss = true){
        $this->setType($type);
        $this->setMessage($message);
        $this->setDismiss($dismiss);
    }
	
	
	////////////
	// GETTER //
	////////////
    public function getType(){
        return $this->type;
    }
    public function getMessage(){
        return $this->message;
    }
    public function getDismiss(){
        return $this->dismiss;
    }
	
	
	////////////
	// SETTER //
	////////////
    public function setType($type){
        $this->type = $type;
    }
    public function setMessage($message){
        $this->message = $message;
    }
    public function setDismiss($dismiss){
        $this->dismiss = $dismiss;
    }
	
	
	///////////////
	// TO STRING //
	///////////////
    public function __toString(){
        $btn = '';
        $class = '';
        if($this->getDismiss()){
            $btn = '
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                 </button>
            ';
            $class = 'alert-dismissible';
        }
        return '
            <div class="alert alert-' . $this->getType() . ' ' . $class . ' fade show" role="alert">
                '. $this->getMessage() .'
                '. $btn. '
            </div>
        ';
    }

}
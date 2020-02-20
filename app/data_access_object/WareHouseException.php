<?php

class WareHouseException extends Exception{

    private $error;

    function __construct($msg, $num, $error = ''){
        
        parent::__construct($msg, $num);
        $this->setError($error);

    }

    public function setError($error){
        $this->error = $error;
    }
    public function getError(){
        return $this->error;
    }

    public function __toString(){
        return $this->getMessage();
    }

}
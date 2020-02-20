<?php

class ShelfBackup extends Shelf {
    
    private $reason;
    private $dateDelte;
    
    public function __construct($code, $material, $numRack, $corridor, $position, $date, $reason, $dateDelete) {
        parent::__construct($code, $material, $numRack, $corridor, $position);
        $this->setDate($date);
        $this->setReason($reason);
        $this->setDateDelte($dateDelete);
    }
    
    function getReason() {
        return $this->reason;
    }

    function getDateDelte() {
        return $this->dateDelte;
    }

    function setReason($reason) {
        $this->reason = $reason;
    }

    function setDateDelte($dateDelte) {
        $this->dateDelte = $dateDelte;
    }


    
    
}

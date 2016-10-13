<?php

namespace onevsone\Arena\Manager;

class Stats extends Player {
   
    public function __construct($name) {
        $this->namedtag["name"] = $name;
    }
    
    public function getRound(){
        return $this->namedtag["game"][$this->namedtag["name"]]["round"];
    }
   
   public function setRound($amount){
        return $this->namedtag["game"][$this->namedtag["name"]]["round"] = $amount;
    }
    
}
?>

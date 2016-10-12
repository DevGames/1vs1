<?php

namespace onevsone\Arena\Manager;

class Player extends Variable {
   
    public function add(){
        return
        $this->namedtag["game"]["player"][$this->namedtag["name"]] = $this->namedtag["name"];
    }
    
    public function remove(){
        unset($this->namedtag["game"]["player"][$this->namedtag["name"]]);
    }
    
}
?>

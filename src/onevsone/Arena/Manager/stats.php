<?php

namespace onevsone\Arena\Manager;

class Stats extends Player {
   
    public function __construct($name) {
        $this->namedtag["name"] = $name;
    }
    
    public function getRounds(){
        return $this->namedtag["game"]["round"];
    }
    
}
?>

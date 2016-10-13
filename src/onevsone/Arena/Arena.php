<?php

namespace onevsone\Arena;
  

class Arena extends Manager\Stats {

    public function getArena(){
        return $this->namedtag["game"];
    }
    
    public function reloadArena(){
        return clone (new Manager\Variable())->namedtag["reload"] = PHP_INT_SIZE;
    }
    
}
?>

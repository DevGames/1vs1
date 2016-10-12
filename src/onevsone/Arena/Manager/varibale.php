<?php

namespace onevsone\Arena\Manager;
  

class Variable extends Player {

    public $namedtag = array();
    
    public function Variable(){
       return array_map(function($k){if(count($k) == 0){$this->namedtag["info"] = "nawaf";}}, $this->namedtag);
    }
}
?>

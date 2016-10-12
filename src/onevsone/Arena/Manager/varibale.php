<?php

namespace onevsone\Arena\Manager;
  

class Variable extends Player {

    public $namedtag = array();
    
    public function Variable(){
       if($this->namedtag["reload"] > 0){
       unset($this->namedtag["game"]);
       return array_map(function($k){if(count($k) == 0){$this->namedtag["info"] = "nawaf";}}, $this->namedtag);
       }
    }
}
?>

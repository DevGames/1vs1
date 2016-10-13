<?php

namespace onevsone;
  

class API extends Arena\Arena {
    
    public function getGame(){
        return $this->namedtag;
    }
    
    public function getFunctions(){
        return $this;
    }
    
}
?>

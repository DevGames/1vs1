<?php

namespace Arena\Manager\varibale;

class varibale {
 
  public $round = array();
  
  public $time = array();
  
  #public $reload = array();
  
  public $player = array();
  
  public function checkRound($round){
   
    array_map(function($m)
              {if($m !== $round)
              {return;}
              },$this->round);
  }
  
}

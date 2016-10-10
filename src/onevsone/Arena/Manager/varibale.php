<?php

namespace Arena\Manager\varibale;

class varibale {
 
  public $round = array();
  
  public $time = array();
  
  #public $reload = array();
  
  public $player = array();
  
  public function checkRound($round,$name = null){ # Garbage
   return array_map(function ($a)
{
  if($a == $round){return;}
},$this->round));
  }
  
}

<?php

namespace onevsone\Arena\Manager;

class Player extends Variable {
   
    public function add(){
        $b = "";
        $this->getServer()->getPluginManager()->callEvent(new \onevsone\root\GameEvent\JoinGameEvent\JoinGameEvent($this->getServer()->getPlayer($this->namedtag["name"]),$b,$this->namedtag["game"]));
        $this->getServer()->getPlayer($this->namedtag["name"])->sendMessage($b);
        $this->namedtag["game"]["player"][$this->namedtag["name"]] = $this->namedtag["name"];
    }
    
    public function remove(){
        unset($this->namedtag["game"]["player"][$this->namedtag["name"]]);
    }
    
}
?>

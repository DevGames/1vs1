<?php

namespace onevsone\root\GameEvent\JoinGameEvent;
  

class JoinGameEvent extends \pocketmine\event\Event implements \pocketmine\event\Cancellable {

    public function __construct($player,$msg,$game) {
        $this->msg = $msg;
        $this->player = $player;
        $this->game = $game;
    }
    
    public function getMessage(){
        return $this->msg;
    }
    
    public function getPlayer(){
        return $this->player;
    }
    
    public function setMessage(){
        return $this->msg;
    }
    
    public function getGame(){
        return $this->game;
    }
    
}
?>

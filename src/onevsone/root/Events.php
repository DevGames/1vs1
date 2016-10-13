<?php

namespace onevsone\root\Events;

class Events implements \pocketmine\event\Listener{
     
     public function onJoinGames(\onevsone\root\GameEvent\JoinGameEvent\JoinGameEvent $ev){
         if(count($ev->getGame()["player"]) == 1){
             $spawn1;
         }
         if(count($ev->getGame()["player"]) == 2){
             $spawn2;
         }
     }
}
?>

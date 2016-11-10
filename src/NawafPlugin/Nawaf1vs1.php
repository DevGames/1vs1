<?php

namespace NawafPlugin;

use pocketmine\math\Vector3;
use pocketmine\plugin\PluginBase;

use pocketmine\event\Listener;
use pocketmine\utils\TextFormat as TXT;
use pocketmine\utils\Config;

use pocketmine\event\player\PlayerInteractEvent;


use pocketmine\Player;

class Nawaf1vs1 extends PluginBase implements Listener {
    
    public $class;
    public $player = array();


    public function __construct() {
        {$this->class["round"] = new Round();}
        {$this->class["mode"] = new mode();}
        {$this->class["player"] = new Player();}
    }
    
    public function onEnable(){
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->g = 0;
        register::game($name, $signx, $signy, $signz, $xp1, $yp1, $zp1, $xp2, $yp2, $zp2,$iditem);
    }
    
    public function onTouch(PlayerInteractEvent $ev){
        $g = register::$reg;
        $b = $ev->getBlock();
        $stats = new statsUpdate($ev->getPlayer()->getName());
        if($b->x == $g["signx"] && $b->y == $g["signy"] && $b->z == $g["signz"]){
            if($this->class["mode"]->mode["start"] !== TRUE){
                
                $this->g++;
                
                $this->player["stats"][statsUpdate::$name] = array(statsUpdate::$name,0,$this->g,$ev->getPlayer());
                $this->player[statsUpdate::$name] = statsUpdate::$name;
                
            if($this->class["player"]->getCount() == 1){
            $ev->getPlayer()->teleport(new Vector3($g["x1"], $g["y1"], $g["z1"]));
            }
            if($this->class["player"]->getCount() == 2){
            $ev->getPlayer()->teleport(new Vector3($g["x1"], $g["y1"], $g["z1"]));
            $this->class["time"]->setTime(60);
            $this->class["mode"]->setWait();
            }
            
            }else{
                
            }
        }
    }
}
class Player {
    
    public function getCount(){
        return (new Nawaf1vs1())->player["stats"][statsUpdate::$name][0];
    }
    
}
class statsUpdate {
    
    public static $name = "";
    
    public function __construct($name) {
        self::$name = $name;
    }
}
class Round {

    public function getRound(){
    return ((new Nawaf1vs1())->class{statsUpdate::$name}[1]);
    }
    
}
class mode {
    
    public function __construct() {
        $this->mode["wait"] = 0;
        $this->mode["stop"] = 0;
        $this->mode["start"] = 0;
    }
    public function setStart(){
        $this->mode["wait"] = 0;
        $this->mode["stop"] = 0;
        $this->mode["start"] = 1;
    }
    public function setWait(){
        $this->mode["wait"] = 1;
        $this->mode["stop"] = 0;
        $this->mode["start"] = 0;
    }
    public function setStop(){
        $this->mode["wait"] = 0;
        $this->mode["stop"] = 1;
        $this->mode["start"] = 0;
    }
    
}
class register {
    
    public static $reg = array();
    
    public static function game($name,$signx,$signy,$signz,$xp1,$yp1,$zp1,$xp2,$yp2,$zp2,$iditems){
        
        self::$reg["name"] = $name;
        self::$reg["signx"] = $signx;
        self::$reg["signy"] = $signy;
        self::$reg["signz"] = $signz;
        self::$reg["x1"] = $xp1;
        self::$reg["y1"] = $yp1;
        self::$reg["z1"] = $zp1;
        self::$reg["x2"] = $xp2;
        self::$reg["y2"] = $yp2;
        self::$reg["z2"] = $zp2;
        
    }
    
}

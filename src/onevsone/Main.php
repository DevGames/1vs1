<?php
namespace onevsone;
class Main extends \pocketmine\plugin\PluginBase implements \pocketmine\event\Listener{
	public function onEnable(){
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
		@mkdir($this->getDataFolder());
		@mkdir($this->getDataFolder()."arena");
		@mkdir($this->getDataFolder()."player");
		}
	public function getArena($name){
		$arena = new \pocketmine\utils\Config($this->getDataFolder()."arena/".$name.".yml",\pocketmine\utils\Config::YAML);
		return $arena;
	}
	public function getPlayerConfig($player){
		$player = new \pocketmine\utils\Config($this->getDataFolder()."player/".$player.".yml",\pocketmine\utils\Config::YAML);
		return $player;
	}
	public function getPlayerArena($player){
			return $this->getPlayerConfig($player)->get("Arena");
	}
	public function onCommand(\pocketmine\command\CommandSender $sender,\pocketmine\command\Command $command, $label,array $args){
		if($command->getName() == "1vs1"){
			if($sender instanceof \pocketmine\Player){
				if($args[0] == "help"){
					$sender->sendMessage("~^-help-^~");
					$sender->sendMessage("/1vs1 join <arena> : join for arena");
					$sender->sendMessage("/1vs1 leave : leave for arena");
					if($sender->isOp()){
						$sender->sendMessage("/1vs1 create <arena> : create new arena");
						$sender->sendMessage("/1vs1 setspawn1 <arena> : set spawn player 1 for arena");
						$sender->sendMessage("/1vs1 setspawn2 <arena> : set spawn player 2 for arena");
					}
					$sender->sendMessage("~^-1vs1-^~");
					return true;				}
				if($args[0] == "join"){
					if(!$this->getArena($args[1])->get("1vs1") == null){
            					$p1 = $this->getArena($args[1])->get("p1");
            					$p2 = $this->getArena($args[1])->get("p2");
						if($p1 == null){
							$this->getArena($args[1])->set("p1", $sender->getPlayer()->getName());
							$this->getArena($args[1])->save();
							$this->getPlayerConfig($sender->getPlayer()->getName())->set("Arena", $args[1]);
							$this->getPlayerConfig($sender->getPlayer()->getName())->save();
							$sender->getPlayer()->sendMessage("Wait a second player");
						}else{
							if($p2 == null){
                						$spawn1 = $arena->get("spawn1");
                						$spawn2 = $arena->get("spawn2");
								$this->getArena($args[1])->set("p2", $sender->getPlayer()->getName());
                						$this->getArena($args[1])->save();
                						$this->getPlayerConfig($sender->getPlayer()->getName())->set("Arena", $args[1]);
                						$this->getPlayerConfig($sender->getPlayer()->getName())->save();
                						$sender->getPlayer($p1)->teleport(\pocketmine\math\Vector3($spawn1[0],$spawn1[1],$spawn1[2],$spawn1[3]));
                						$sender->getPlayer($p2)->teleport(\pocketmine\math\Vector3($spawn2[0],$spawn2[1],$spawn2[2],$spawn2[3]));
                						$sender->getPlayer($p1)->sendMessage("Go Go Go.");
                						$sender->getPlayer($p2)->sendMessage("Go Go Go.");
							}else{
								$sender->getPlayer()->sendMessage("This arena $args[1] full");
							}
					}else{
						$sender->sendMessage("This arena [$args[1]] not found !");
					}
				}
				if($args[0] == "leave"){
					$p1 = $this->getArena($this->getPlayerArena($sender->getPlayer()->getName()))->get("p1");
					$p2 =
					if($this->getArena($this->getPlayerArena($sender->getPlayer()->getName()))->get())
					$this->getPlayerConfig($sender->getPlayer()->getName())->unset("Arena");
					$this->getPlayerConfig($sender->getPlayer()->getName())->save();
				}
				if($sender->isOp()){
					$arena = $this->getArena($args[1]);
					$x = $sender->getFloorX();
					$y = $sender->getFloorY();
					$z = $sender->getFloorZ();
					$level = $sender->getLevel();
					if($args[0] == "create"){
						if($arena->get("1vs1") == null){
							$arena->set("1vs1",true);
							$arena->save();
							$sender->sendMessage("new create arena [$args[1]]");
						}else{
							$sender->sendMessage("this arena [$args[1]] allredy extis");
						}
						return true;
					}
					if($args[0] == "setspawn1"){
						$arena->set("spawn1",array($x,$y,$z,$level));
						$arena->save();
						$sender->sendMessage("spawn player 1 x: $x y: $y z: $z level: $level");
						return true;
					}
					if($args[0] == "setspawn2"){
						$arena->set("spawn2",array($x,$y,$z,$level));
						$arena->save();
						$sender->sendMessage("spawn player 2 x: $x y: $y z: $z level: $level");
						return true;
					}
				}
			}else{
				$sender->sendMessage("Please run in-game!");
			}
		}
	}
	public function SignClick(\pocketmine\event\player\PlayerInteractEvent $event){
		$sign = $event->getPlayer()->getLevel()->getTile($event->getBlock());
		if($sign instanceof \pocketmine\tile\Sign){
			$text = $sign->getText();
			if($text[0] == "[1vs1]"){
				$arena = $this->getArena($text[1]);
				$spawn1 = $arena->get("spawn1");
				$spawn2 = $arena->get("spawn2");
				$p1 = $arena->get("p1");
				$p2 = $arena->get("p2");
				if(!$arena->get("1vs1") == null){
					if($arena->get("p1") == null){
						$arena->set("p1", $event->getPlayer()->getName());
						$arena->save();
						$event->getPlayer()->sendMessage("Wait a second player");
					}else{
						if($arena->get("p2") == null){
							$arena->set("p2", $event->getPlayer()->getName());
							$arena->save();
							$event->getPlayer($p1)->teleport(\pocketmine\math\Vector3($spawn1[0],$spawn1[1],$spawn1[2],$spawn1[3]));
							$event->getPlayer($p2)->teleport(\pocketmine\math\Vector3($spawn2[0],$spawn2[1],$spawn2[2],$spawn2[3]));
							$event->getPlayer($p1)->sendMessage("Go Go Go.");
							$event->getPlayer($p2)->sendMessage("Go Go Go.");
						}else{
							$event->getPlayer()->sendMessage("This arena $text[1] full");
						}
					}
				}
			}
		}
	}
}
?>

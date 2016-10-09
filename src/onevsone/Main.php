<?php
namespace onevsone;
class Main extends \pocketmine\plugin\PluginBase implements \pocketmine\event\Listener{
	public function onEnable(){
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
		@mkdir($this->getDataFolder());
		@mkdir($this->getDataFolder()."arena");
	}
	public function getArena($name){
		$arena = new \pocketmine\utils\Config($this->getDataFolder()."arena/".$name.".yml",\pocketmine\utils\Config::YAML);
		return $arena;
	}
	public function onCommand(\pocketmine\command\CommandSender $sender,\pocketmine\command\Command $command, $label,array $args){
		if($command->getName() == "1vs1"){
			if($sender instanceof \pocketmine\Player){
				if(isset($args[0])){
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
					}
					if($args[0] == "setspawn1"){
						$arena->set("spawn1",array($x,$y,$z,$level));
						$arena->save();
						$sender->sendMessage("spawn player 1 x: $x y: $y z: $z level: $level");
					}
					if($args[0] == "setspawn2"){
						$arena->set("spawn2",array($x,$y,$z,$level));
						$arena->save();
						$sender->sendMessage("spawn player 2 x: $x y: $y z: $z level: $level");
					}
				}
			}else{
				$sender->sendMessage("This command in Game !");
			}
		}
	}
}
?>

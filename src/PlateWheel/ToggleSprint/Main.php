<?php

namespace PlateWheel\ToggleSprint;

use pocketmine\Server;
use pocketmine\player\Player;

use pocketmine\plugin\PluginBase;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerMoveEvent;

use pocketmine\utils\TextFormat as TF;

class Main extends PluginBase implements Listener {

	public $mode = [];

	public function onEnable(): void{
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
		$this->getLogger()->info(TF::RED . "PM4 is epic UvU. ToggleSprint actived!");
	}

	public function onCommand(CommandSender $sender, Command $cmd, String $label, Array $args) : bool {

		switch($cmd->getName()){
			case "sprint":
			 if($sender instanceof Player){
			 	if(isset($this->mode[$sender->getName()])){
			 		unset($this->mode[$sender->getName()]);
			 		$sender->sendMessage(TF::GOLD . "[Sprint]" . TF::RED . " Toggle Sprint mode deactived!");
			 	} else {
			 		$this->mode[$sender->getName()] = $sender->getName();
			 		$sender->sendMessage(TF::GOLD . "[Sprint]" . TF::GREEN . " Toggle Sprint mode actived!");
			 	}
			 } else {
			 	$sender->sendMessage("Player only but yo");
			 }
			break;
		}

		return true;
	}

	public function onMove(PlayerMoveEvent $event){
		$player = $event->getPlayer();
		if(isset($this->mode[$player->getName()])){
			$player->setSprinting();
		}
	}

}
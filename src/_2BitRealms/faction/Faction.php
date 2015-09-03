<?php
namespace _2BitRealms\faction;
use pocketmine\utils\TextFormat as Colour;
use pocketmine\Server;
class Faction {
	
	private $name;
	private $description;
	private $leader;
	
	public function getName(){
		return $this->name;
	}
	
	public function getDescription(){
		return $this->description;
	}
	
	public function __construct($name, $leader){
		$this->name = $name;
		$this->description = "Default description :(";
		$this->leader = $leader;
		
		$this->broacastAll(Colour::WHITE. $leader->getDisplayName(). Colour::YELLOW. " created the faction ". Colour::WHITE. $name);
		$leader->sendMessage(Colour::YELLOW. "Faction succesfully created!");
	}
	
	public function broadcastAll($message){
		foreach($this->getServer()->getOnlinePlayers() as $p){
			if(!$p === $leader){
				$p->sendMessage($message);
			}
		}
	}
	
}
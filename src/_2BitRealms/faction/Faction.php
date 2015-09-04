<?php
namespace _2BitRealms\faction;
use _2BitRealms\_2BitFacs;
use pocketmine\utils\TextFormat as Colour;
use pocketmine\level\Position;
use pocketmine\Server;
class Faction {
	
	private $name;
	private $description;
	private $leader;
	private $players;
	private $plugin;
	private $home
	
	public function getName(){
		return $this->name;
	}
	
	public function getDescription(){
		return $this->description;
	}
	
	public function getPlayers() {
		return $this->players;
	}
	
	public function getHome() {
		return $this->home;	
	}
	
	public function __construct(Main $plugin, Player $leader, $name, Position $home = null){
		$this->plugin = $plugin;
		$this->name = $name;
		$this->description = "Default description :(";
		$this->leader = $leader;
		$this->home = $home;
		$this->players = array("Leader" => $leader->getDisplayName, "Mods" => "", "Members" => "";  //Can be used for /f who & getting the leader.
		$this->broacastAll(Colour::WHITE. $leader->getDisplayName(). Colour::YELLOW. " created the faction ". Colour::WHITE. $name);
		$leader->sendMessage(Colour::YELLOW. "Faction succesfully created!");
		$this->storeFac();
	}
	
	public function storeFac() {
		$db = $this->plugin->db;
		$sql = $db->prepare("INSERT INTO factions (name, description, players, home) VALUES (:name, :description, :players, :home);");
		$sql->bindValue(":name", $this->name);
		$sql->bindValue(":description", $this->description);
		$sql->bindValue(":players", $this->players);
		$sql->bindValue(":home", $this->home);
		$result = $sql->execute();
		return;
	}
	
	public function broadcastAll($message){
		foreach($this->getServer()->getOnlinePlayers() as $p){
			if(!$p === $leader){
				$p->sendMessage($message);
			}
		}
	}
	
}

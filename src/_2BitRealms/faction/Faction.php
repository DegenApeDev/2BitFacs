<?php
namespace _2BitRealms\faction;
use _2BitRealms\_2BitFacs as Main;
use pocketmine\utils\TextFormat as Colour;
use pocketmine\level\Position;
use pocketmine\Server;
class Faction {
	
	private $name;
	private $description;
	private $leader;
	private $plugin;
	private $mods;
	private $members;
	
	public function getName(){
		return $this->name;
	}
	
	public function getDescription(){
		return $this->description;
	}
	
	public function getLeader() {
		return $this->leader;
	}
	
	public function getMods() {
		return $this->arrayString($this->mods);
	}
	
	public function getMembers() {
		return $this->arrayString($this->members);
	}
	
	//If a Moderaotr, player will be demoted to Member. If player is a Members, that player will be kicked from the faction.
	public function demote($player) {
		$mods = $this->getMods();
		$members = $this->getMembers();
		foreach($mods as $key => $mod) {
			if($mod === $player) {
				unset($mods[$key]);
				array_push($members, $mod);
				$this->mods = implode(",", $mods);
				$this->members = implode(",", $members);
				$this->storeFac();
				return;
			}
		}
		foreach($this->members as $key => $member) {
			if($member === $player) {
				unset($members[$key]);
				$this->members = implode(",", $members);
				$this->storeFac();
				return;
			}
		}
	}
	
   //TO BE USED FOR INTERNAL USE ONLY
	public function __construct(Main $plugin, Player $leader, $name, $mods = null, $members = null){
		$this->plugin = $plugin;
		$this->name = $name;
		$this->description = "Default description :(";
		$this->leader = $leader;
		$this->mods = $mods;
		$this->members = $members;
		
		//Send the faction created message to everyone but the leader
		$this->broacastAll(Colour::WHITE. $leader->getDisplayName(). Colour::YELLOW. " created the faction ". Colour::WHITE. $name);
		$leader->sendMessage(Colour::YELLOW. "Faction succesfully created!");

       //Store faction in a database
		$this->storeFac();
	}
	
	public function storeFac() {
		$db = $this->plugin->db;
		$sql = $db->prepare("INSERT INTO factions (name, description, leader, mods, members) VALUES (:name, :description, :leader, :mods, :members);");
		$sql->bindValue(":name", $this->name);
		$sql->bindValue(":description", $this->description);
		$sql->bindValue(":leader", $this->leader);
		$sql->bindValue(":mods", $this->mods);
		$sql->bindValue(":members", $this->members);
		$result = $sql->execute();
		return;
	}
	
	public function broadcastAll($message){
		foreach($this->getServer()->getOnlinePlayers() as $p){
			if(!$p === $this->leader){
				$p->sendMessage($message);
			}
		}
	}
	
	//Turns a string into an array
	public function arrayString($string) {
		if($string === null) {
			return null;
		} else {
			$array = explode(",", $string);
			return $array;
		}
	}
	
}

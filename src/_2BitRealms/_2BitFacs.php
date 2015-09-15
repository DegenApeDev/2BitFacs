<?php
namespace _2BitRealms;
use pocketmine\utils\Config;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use _2BitRealms\command\SubCommandMap;
class _2BitFacs extends PluginBase implements Listener {
	
	private $db;
	
	public function onEnable(){

      //Events
		$this->getServer()->getPluginManager()->registerEvents($this, $this);

      //Config
		$this->saveDefaultConfig();
		
		//Commands
	    $this->getServer()->getCommandMap()->register(SubCommandMap::class, new SubCommandMap($this));
	    
	    //Database
	    $this->db = new \SQLite3($this->getDataFolder() . "_2BitFacs.db");
	    $this->db->exec("CREATE TABLE IF NOT EXISTS factions (name VARCHAR(255), description VARCHAR(255), leader VARCHAR(255), mods VARCHAR(255), members VARCHAR(255);");
	}
	
	public function getDatabase(){
		return $this->db;
	}
	
	public function onDisable(){
		$this->db->close();
	}
	
}

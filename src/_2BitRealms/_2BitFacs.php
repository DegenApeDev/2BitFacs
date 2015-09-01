
<?php
namespace _2BitRealms;
use pocketmine\utils\Config;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
class _2BitFacs extends PluginBase implements Listener {
	
	public function onEnable(){
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
		$this->saveDefaultConfig();
		$this->registerCommands();
	}
	
	public function registerCommands(){
		//TODO
	}
	
}
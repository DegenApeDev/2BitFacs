<?php
namespace _2BitRealms;
use pocketmine\utils\Config;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use _2BitFacs\command\SubCommandMap;
class _2BitFacs extends PluginBase implements Listener {
	
	public function onEnable(){
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
		$this->saveDefaultConfig();
	    $this->getServer()->getCommandMap()->register(SubCommandMap::class, new SubCommandMap($this));
	}
	
}
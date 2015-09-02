<?php
namespace _2BitRealms\command;
use _2BitRealms\_2BitFacs;
use pocketmine\command\CommandSender;
abstract class SubCommand{
	
    /** @var _2BitFacs */
    private $plugin;
    /**
     * @param _2BitFacs $plugin
     */
    public function __construct(_2BitFacs $plugin){
        $this->plugin = $plugin;
    }
    /**
     * @return _2BitFacs
     */
    public final function getPlugin(){
        return $this->plugin;
    }
    /**
     * @param CommandSender $sender
     * @return bool
     */
    public abstract function canUse(CommandSender $sender);
    /**
     * @return string
     */
    public abstract function getUsage();
    /**
     * @return string
     */
    public abstract function getName();
    /**
     * @return string
     */
    public abstract function getDescription();
    /**
     * @return string[]
     */
    public abstract function getAliases();
    /**
     * @param CommandSender $sender
     * @param string[] $args
     * @return bool
     */
    public abstract function execute(CommandSender $sender, array $args);
	
	}
	
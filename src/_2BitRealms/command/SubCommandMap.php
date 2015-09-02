<?php
namespace _2BitRealms\command;
use pocketmine\command\PluginCommand;
use pocketmine\command\CommandSender;
use pocketmine\utils\TextFormat;
use pocketmine\Player;
use _2BitRealms\_2BitFacs;
use _2BitRealms\command\subcommand\AboutSubCommand;
use _2BitRealms\command\subcommand\CreateSubCommand;
class SubCommandMap extends PluginCommand {
	
    private $subCommands = [];
    /* @var SubCommand[] */
    private $commandObjects = [];
	
    public function __construct(_2BitFacs $plugin) {
        parent::__construct("f", $plugin);
        $this->setAliases(["faction"]);
        $this->setPermission("2bitfacs.command.f");
        $this->setDescription("Main command for _2BitFacs!");
        $this->loadSubCommand(new AboutSubCommand($plugin));
        $this->loadSubCommand(new CreateSubCommand($plugin));
    }
	
    private function loadSubCommand(Subcommand $command) {
        $this->commandObjects[] = $command;
        $commandId = count($this->commandObjects) - 1;
        $this->subCommands[$command->getName()] = $commandId;
        foreach ($command->getAliases() as $alias) {
            $this->subCommands[$alias] = $commandId;
        }
    }
	
    public function execute(CommandSender $sender, $alias, array $args) {
		if (!isset($args[0])) {
            return $this->sendHelp($sender);
        }
        $subCommand = strtolower(array_shift($args));
        if (!isset($this->subCommands[$subCommand])) {
            return $this->sendHelp($sender);
        }
        $command = $this->commandObjects[$this->subCommands[$subCommand]];
        $canUse = $command->canUse($sender);
        if ($canUse) {
            if (!$command->execute($sender, $args)) {
            //    $sender->sendMessage(TextFormat::YELLOW."Usage: /f " . $command->getName() . " " . $command->getUsage());
            }
        } elseif (!($sender instanceof Player)) {
            $sender->sendMessage(TextFormat::RED . "Please run this command in-game.");
        } else {
            $sender->sendMessage(TextFormat::RED. "You do not have permissions to run this command");
        }
        return true;
	}
	
	public function sendHelp(Player $player){
		$player->sendMessage("TODO");
	}
	
}
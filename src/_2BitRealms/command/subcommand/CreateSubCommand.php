<?php
namespace _2BitRealms\command\subcommand;
use pocketmine\command\CommandSender;
use pocketmine\Player;
use pocketmine\utils\TextFormat as Colour;
use _2BitRealms\command\Subcommand;
use _2BitRealms\faction\Faction;
class CreateSubCommand extends SubCommand {

    public function canUse(CommandSender $sender) {
        return ($sender instanceof Player) and $sender->hasPermission("2bitfacs.command.f");
    }

    public function getUsage() {
        return "null";
    }

    public function getName() {
        return "create";
    }

    public function getDescription() {
        return "Create a new faction";
    }

    public function getAliases() {
        return [];
    }

    public function execute(CommandSender $sender, array $args) {
        if(count($args) <= 0){
			$sender->sendMessage(Colour::YELLOW. "Please enter a faction name");
			return true;
		}
		if(count($args) >= 2){
			$sender->sendMessage(Colour::RED. "Too many arguments!");
			$sender->sendMessage(Colour::RED. "Usage: /f create <faction name>");
			return true;
		}
		if(!(ctype_alnum($args[0]))) {
			$sender->sendMessage(Colour::YELLOW. "Faction name can only contain letters");
			return true;
		}
		$name = $args[0];
		$leader = $sender;
		$faction = new Faction($name, $leader);
		$sender->getServer()->broadcastMessage(Colour::WHITE. $sender->getName(). Colour::YELLOW. " created the faction ". $name);
		return true;
    }

}
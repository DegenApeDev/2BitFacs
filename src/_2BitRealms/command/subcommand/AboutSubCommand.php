<?php
namespace _2BitRealms\command\subcommand;
use pocketmine\command\CommandSender;
use pocketmine\Player;
use pocketmine\utils\TextFormat;
use _2BitRealms\command\Subcommand;
class AboutSubCommand extends SubCommand {
	
    public function canUse(CommandSender $sender) {
        return true;
    }
	
    public function getUsage() {
        return "[name]";
    }
	
    public function getName() {
        return "about";
    }
	
    public function getDescription() {
        return "Displays info about the plugin";
    }
	
    public function getAliases() {
        return [];
    }
	
    public function execute(CommandSender $sender, array $args) {
        $sender->sendMessage("§b_2BitFacs §eby §cDevBrad§e,§c 64FF00§e, and §cTheDiamondYT");
		$sender->sendMessage("§bhttps://github.com/2-BitRealms/_2BitFacs");
		$sender->sendMessage("§bAll Rights Reserved");
    }
	
}
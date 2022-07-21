<?php

namespace Jason8831\Ping\Commands;

use Jason8831\Ping\Main;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\lang\Translatable;
use pocketmine\player\Player;
use pocketmine\Server;
use pocketmine\utils\Config;

class Ping extends Command
{

    public function __construct(string $name, Translatable|string $description = "", Translatable|string|null $usageMessage = null, array $aliases = [])
    {
        parent::__construct($name, $description, $usageMessage, $aliases);
    }


    public function execute(CommandSender $sender, string $commandLabel, array $args)
    {

        $config = new Config(Main::getInstance()->getDataFolder() . "config.yml", Config::YAML);
        if($sender instanceof Player){
            if(!isset($args[0])){
                $ping = $sender->getNetworkSession()->getPing();
                $messageme = str_replace("{ping}", $ping, $config->get("PingMeMessage"));
                $sender->sendMessage($messageme);
            }else{
                $target = Server::getInstance()->getPlayerByPrefix($args[0]);
                $ping = $target->getNetworkSession()->getPing();
                $messagetarget = str_replace(["{ping}", "{player}"], [$ping, $target->getName()], $config->get("PingTarget"));
                $sender->sendMessage($messagetarget);
            }
        }
    }
}
<?php

namespace Jason8831\Ping;

use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;

class Main extends PluginBase implements Listener
{

    public Config $config;

    /**
     * @var Main
     */
    private static $instance;

    public function onEnable(): void
    {
        self::$instance = $this;
        $this->getLogger()->info("§f[§l§4Ping Commande§r§f]: Activée");
        $this->saveResource("config.yml");

        $this->getServer()->getCommandMap()->registerAll("all", [
            new Commands\Ping(name: "ping", description: "permet de voir sont ping ou le ping d'un autre joueur", usageMessage: "ping")
        ]);
    }

    public static function getInstance(): self{
        return self::$instance;
    }
}
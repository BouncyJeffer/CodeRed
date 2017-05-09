<?php
namespace BouncyJeffer;
use pocketmine\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\Server;
use pocketmine\utils\TextFormat;
class main extends PluginBase {
  public function onLoad(){
    $this->getLogger()->info(TextFormat::YELLOW."Currently loading...");
  }
  public function onEnable(){
    $this->getLogger()->info(TextFormat::GREEN."has been started!");
  }
  public function onDisable(){
    $this->getLogger()->info(TextFormat::RED."disabled.");
  }
}
?>

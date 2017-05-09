<?php
/** Being coded by BouncyJeffer, this plugin is not functional yet. Please wait to download.**/
namespace BouncyJeffer;
use pocketmine\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\Server;
use pocketmine\utils\TextFormat;
class main extends PluginBase {
  public $prefix = TextFormat::YELLOW."[".TextFormat::RED."CodeRed".TextFormat::YELLOW."] ".TextFornat::WHITE.";
  public function onLoad(){
    $this->getLogger()->info(TextFormat::YELLOW."Currently loading...");
  }
  public function onEnable(){
    $this->getLogger()->info(TextFormat::GREEN."has been started!");
  }
  public function onDisable(){
    $this->getLogger()->info(TextFormat::RED."disabled.");
  }
  public function onCommand(CommandSender $sender, Command $command, $label, array $args){
    switch(strtolower($command->getName()){
      case "code":
      if(count($args) < 1){
        $sender->sendMessage($this->prefix."Invalid syntax. /code <operation>");
      } else {
        switch(strtolower($args[0])){
          case "kickall":
          $sender->sendMessage($this->prefix."Kicking all players.");
            foreach($this->getServer()->getOnlinePlayers() as $p){
            if($p !== $sender){
            $p->kick("An emergency has ocurred on the server. Kicking all players.");
            }
            }
          break;
          default:
            $sender->sendMessage($this->prefix."Unknown operation, do ".TextFormat::GRAY."/code ?".TextFormat::WHITE." for help.");
          break;
        }
      }
      break;
    }
  }
}
?>

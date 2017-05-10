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
  public $prefix = TextFormat::YELLOW."[".TextFormat::RED."CodeRed".TextFormat::YELLOW."] ".TextFormat::WHITE;
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
    $cmd = strtolower($command->getName());
    switch($cmd){
      case "code":
      if(count($args) < 1){
        $sender->sendMessage($this->prefix."This server is running CodeRed ".TextFormat::GRAY."BETA".TextFormat::WHITE." Try /code ? for help.");
      } else {
        switch($args[0]){
          case "kickall":
          $sender->sendMessage($this->prefix."Kicking all players...");
          $this->getLogger()->warning($sender->getName()." kicked all players offline.");
          foreach($this->getServer()->getOnlinePlayers() as $p){
            if($p !== $sender){
              $p->kick(TextFormat::RED."\n\nAn event has occurred causing us to kick all players.");
            }
          }
          break;
          case "say":
          $msg = substr(implode(" ", $args), 3);
          $this->getLogger()->info($sender->getName()."sent an important message that reads ".TextFormat::AQUA.$msg);
          foreach($this->getServer()->getOnlinePlayers() as $p){
            $p->sendMessage(TextFormat::GRAY.TextFormat::BOLD."[".TextFormat::RED."IMPORTANT".TextFormat::GRAY."]".TextFormat::RESET.TextFormat::YELLOW.$msg);
          }
          break;
          case "?":
          $sender->sendMessage($this->prefix."Commands: ");
          $sender->sendMessage(TextFormat::GRAY."- ".TextFormat::WHITE."/code kickall (Kick all players)");
          $sender->sendMessage(TextFormat::GRAY."For more help, contact me on twitter @BouncyJeffer.");
          break;
          default:
          $sender->sendMessage($this->prefix."Operation not found. Try ".TextFormat::GRAY."/code ?".TextFormat::WHITE." for help.");
          break;
        }
      }
      break;
    }
    return true;
  }
}
?>

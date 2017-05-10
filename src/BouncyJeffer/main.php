<?php
/** Coded by BouncyJeffer. Twitter @BouncyJeffer. Github @BouncyJeffer. Enjoy my plugin!**/
namespace BouncyJeffer;
use pocketmine\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\Server;
use pocketmine\utils\TextFormat;
use pocketmine\event\player\PlayerMoveEvent;
use pocketmine\event\player\PlayerChatEvent;
use pocketmine\event\Listener;
class main extends PluginBase implements Listener {
  public $canMove = true;
  public $canChat = true;
  public $prefix = TextFormat::YELLOW."[".TextFormat::RED."CodeRed".TextFormat::YELLOW."] ".TextFormat::WHITE;
  public function onLoad(){
    $this->getLogger()->info(TextFormat::YELLOW."Currently loading...");
  }

  public function onEnable(){
    $this->getLogger()->info(TextFormat::GREEN."has been started!");
    $this->getServer()->getPluginManager()->registerEvents($this, $this);
  }

  public function onDisable(){
    $this->getLogger()->info(TextFormat::RED."disabled.");
  }

  public function onMove(PlayerMoveEvent $event){
    if($this->canMove !== true){
      $event->setCancelled(true);
      $event->getPlayer()->sendPopup(TextFormat::RED."Sorry, all players are currently frozen.");
    }
  }
  public function onChat(PlayerChatEvent $event){
    if($this->canChat !== true){
      $event->setCancelled(true);
      $event->getPlayer()->sendMessage(TextFormat::RED."Sorry, no players can chat at this time.");
    }
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
          $this->getLogger()->info($sender->getName()." sent an important message that reads ".TextFormat::AQUA.$msg);
          foreach($this->getServer()->getOnlinePlayers() as $p){
            $p->sendMessage(TextFormat::GRAY.TextFormat::BOLD."[".TextFormat::RED."IMPORTANT".TextFormat::GRAY."]".TextFormat::RESET.TextFormat::YELLOW.$msg);
            $p->sendPopup(TextFormat::BOLD.TextFormat::RED."An important message was sent in chat.");
          }
          break;
          case "freeze":
          if($this->canMove == true){
            $this->canMove = false;
            $this->getLogger()->info($sender->getName()." frozen all players.");
            $sender->sendMessage($this->prefix."Players can no longer move!");
            foreach($this->getServer()->getOnlinePlayers() as $p){
              $p->sendMessage(TextFormat::RED."You have been frozen.");
            }
          } else {
            $this->canMove = true;
            $this->getLogger()->info($sender->getName()." unfroze all players.");
            $sender->sendMessage($this->prefix."Players can now move!");
            foreach($this->getServer()->getOnlinePlayers() as $p){
              $p->sendMessage(TextFormat::RED."You are now unfrozen.");
            }
          }
          break;
          case "gamemodeall":
          case "gm-all":
          case "gmall":
          if(count($args) < 1){
            $sender->sendMessage($this->prefix."You must specify a gamemode!");
          } else {
            $gameMode = Server::getGamemodeFromString($args[1]);
            foreach($this->getServer()->getOnlinePlayers() as $p){
              $p->setGamemode($gameMode);
              $p->sendMessage(TextFormat::RED."Your gamemode has been updated.");
            }
          }
          break;
          case "chat":
          if($this->canChat == true){
            $this->canChat = false;
            $this->getLogger()->info($sender->getName()." disabled everyone's chat.");
            $sender->sendMessage($this->prefix."Players can no longer chat!");
            foreach($this->getServer()->getOnlinePlayers() as $p){
              $p->sendMessage(TextFormat::RED."You can no longer chat!");
            }
          } else {
            $this->canChat = true;
            $this->getLogger()->info($sender->getName()." enabled everyone's chat.");
            $sender->sendMessage($this->prefix."Players can now chat!");
            foreach($this->getServer()->getOnlinePlayers() as $p){
              $p->sendMessage(TextFormat::RED."You can now chat!");
            }
          }
          break;
          case "help":
          case "?":
          $sender->sendMessage($this->prefix."Commands: ");
          $sender->sendMessage(TextFormat::GRAY."- ".TextFormat::WHITE."/code kickall (Kick all players)");
          $sender->sendMessage(TextFormat::GRAY."- ".TextFormat::WHITE."/code say <message> (Send an important message to chat.");
          $sender->sendMessage(TextFormat::GRAY."- ".TextFormat::WHITE."/code gmall <gamemode> (Update every player's gamemode.");
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

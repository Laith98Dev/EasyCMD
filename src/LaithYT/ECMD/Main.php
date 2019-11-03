<?php

declare(strict_types=1);

namespace LaithYT\ECMD;

use pocketmine\plugin\PluginBase as P;
use pocketmine\event\Listener as L;

use pocketmine\Server;
use pocketmine\Player;

use pocketmine\command\CommandSender;
use pocketmine\command\Command;

use pocketmine\item\Item;
use pocketmine\inventory\Inventory;

class Main extends P implements L {
	
	public function onLoad(){
		$this->getLogger()->notice(base64_decode("VGhlIFBsdWdpbiBDcmVhdGUgQnkgTGFpdGhZb3V0dWJlciBDb3B5cmlnaHQgMjAxOSBMYWl0aFlU"));
		$this->getLogger()->info("Done Load Plugin");
	}
	
	public function onEnable() : void{
		$this->getLogger()->notice(base64_decode("VGhlIFBsdWdpbiBDcmVhdGUgQnkgTGFpdGhZb3V0dWJlciBDb3B5cmlnaHQgMjAxOSBMYWl0aFlU"));
		$this->getLogger()->info(" Enabled ");
		$this->getLogger()->info(" Plugin By Laith Youtuber ");

	}
	
	public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args) : bool{
		switch($cmd->getName()){
			case "ecmd":
				if($sender instanceof Player){
					$this->OpenUI($sender);
				}
			break;
		}
		return true;
	}
	
	public function GetPing($player){
		$ping = $player->getPing();
		$player->sendTip("§4§lYour Ping§e " . $ping . "§l§b ms");
	}
	
	public function SendInfo($player){
		$player->sendMessage("EasyCMD By LaithYT/n/nYoutube: LaithYoutuber/n/nFaceBook: Laith A Al Hadda/n/nFun!");
	}
	
	public function OpenUI($player){
		$api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
		$form = $api->createSimpleForm(function (Player $player, int $data = null){
		$result = $data;
		if($result === null){
			return true;
			}
			 switch($result){
				case 0:
					$this->SendInfo($player);
				break;
				
				case 1:
					$this->getServer()->dispatchCommand($player, "reload");
				break;
				
				case 2:
					$this->getServer()->dispatchCommand($player, "save-all");
				break;
				
				case 3:
					$this->getServer()->dispatchCommand($player, "pl");
				break;
				
				case 4:
					$player->setAllowFlight(true);
					$player->addTitle("§6§lFly", "§eEnabled", 10, 30, 10);
				break;
				
				case 5:
					$player->setAllowFlight(false);
					$player->setGamemode(0);
					$player->addTitle("§6§lFly", "§cDisbled", 10, 30, 10);
				break;
				
				case 6:
					$this->GetPing($player);
				break;
				}
		});
		$form->setTitle("EasyCMD");
		$form->setContent("Please Select Command");
		$form->addButton("Info");
		$form->addButton("Reload");
		$form->addButton("Save-All");
		$form->addButton("Plugins");
		$form->addButton("Fly [ON]");
		$form->addButton("Fly [OFF]");
		$form->addButton("Ping");
		$form->sendToPlayer($player);
		return $form;
	 }
	
	public function onDisable() : void{
		$this->getLogger()->info(" Disbled ");
	}
}

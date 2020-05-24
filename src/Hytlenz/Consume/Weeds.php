<?php

namespace Hytlenz\Consume;

use Hytlenz\Loader;

use pocketmine\entity\Effect;
use pocketmine\entity\EffectInstance;
use pocketmine\event\Listener;
use pocketmine\item\Potion;
use pocketmine\event\player\PlayerItemConsumeEvent;
use pocketmine\event\player\PlayerItemHeldEvent;

use pocketmine\event\player\PlayerInteractEvent;

use pocketmine\item\Item;
use pocketmine\Player;
use pocketmine\utils\TextFormat as TF;

class Weeds implements Listener {
	
	public function onInteract(PlayerInteractEvent $event){
		
		$player = $event->getPlayer();
		
		if($event->getItem()->getId() === 399) { //Rotten Flesh
		
			$damage = $event->getItem()->getDamage();
			
			switch($damage) {
				
				case 0:
				
				$player->addEffect(new EffectInstance(Effect::getEffect(Effect::LEVITATION), 30*20, 1, false));
				$player->addEffect(new EffectInstance(Effect::getEffect(Effect::INVISIBILITY), 60*20, 2, false));
					
					$item = Item::get(Item::NETHERSTAR, 0, 1);
					$player->getInventory()->removeItem($item);

				
				$player->addTitle(TF::DARK_GRAY . TF::BOLD . "(" . TF::GREEN . "!" . TF::DARK_GRAY . ") " . TF::RESET . TF::GRAY . "§bPanic Star", TF::GREEN . TF::BOLD . "");
				return true;
				break;
				
				
				
			}
		}
	}
	
	public function onHeld(PlayerItemHeldEvent $event) {
		
		$player = $event->getPlayer();
		
		if($event->getItem()->getId() === 399) {
			
			$damage = $event->getItem()->getDamage();
			$hand = $player->getInventory()->getItemInHand();
			
			switch($damage) {
				
				case 0:
				
				$item = Item::get(Item::NETHERSTAR, 0, 1);
				
				//$player->getInventory()->removeItem($item);
				
				$item->setCustomName(TF::RESET . TF::GREEN . TF::BOLD . "Panic Star" . PHP_EOL . PHP_EOL .
									 TF::RESET . TF::DARK_GRAY . " * " . TF::GREEN . "LEVITATION I" . TF::GRAY . " (6:00)" . PHP_EOL .
									
                            //  $player->getInventory()->addItem($item);				 TF::DARK_GRAY . " * " . TF::GREEN . "INVISIBILITY II" . TF::GRAY . " (6:00)");
				

				return true;
				break;
				
			}
			
			if($hand->hasCustomName()) {
				
				$event->setCancelled();
				
			}
		}
	}
}

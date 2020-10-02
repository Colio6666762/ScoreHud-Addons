<?php

declare(strict_types = 1);

/**
 * @name MultiEconomyAddon
 * @version 1.0.0
 * @main JackMD\ScoreHud\Addons\MultiEconomyAddon
 * @depend MultiEconomy
 */
namespace JackMD\ScoreHud\Addons
{

	use JackMD\ScoreHud\addon\Addon;
	use JackMD\ScoreHud\addon\AddonBase;
	use pocketmine\Player;
	use twisted\multieconomy\MultiEconomy;

	class MultiEconomyAddon extends AddonBase {

		/** @var MultiEconomy */
		private $multieconomy;

		public function onEnable(): void{
			$this->multieconomy = $this->getServer()->getPluginManager()->getPlugin("MultiEconomy");
		}

		/**
		 * @param Player $player
		 * @return array
		 */
		public function getProcessedTags(Player $player): array{
		    $tokens = $this->multieconomy->getCurrency("tokens");
		    $coins = $this->multieconomy->getCurrency("coins");
			return [
				"{coins}" => $coins->getBalance($player->getName()), 
				"{tokens}" => $tokens->getBalance($player->getName())
			];
		}
	}
}
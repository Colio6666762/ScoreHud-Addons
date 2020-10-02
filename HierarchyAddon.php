<?php
declare(strict_types = 1);

/**
 * @name HierarchyAddon
 * @version 1.0.0
 * @main   JackMD\ScoreHud\Addons\HierarchyAddon
 * @depend Hierarchy
 */
namespace JackMD\ScoreHud\Addons
{

	use CortexPE\Hierarchy\member\Member;
	use CortexPE\Hierarchy\role\Role;
	use JackMD\ScoreHud\addon\AddonBase;
	use pocketmine\Player;
	use CortexPE\Hierarchy\Hierarchy;
	use CortexPE\Hierarchy\member\MemberFactory;

	class HierarchyAddon extends AddonBase{

		/** @var Hierarchy */
		private $hrk;
		/** @var MemberFactory */
		private $memFac;

		public function onEnable(): void{
			$this->hrk = $this->getServer()->getPluginManager()->getPlugin("Hierarchy");
			if($this->hrk instanceof Hierarchy){
				$this->memFac = $this->hrk->getMemberFactory();
			}
		}

		/**
		 * @param Player $player
		 * @return array
		 */
		public function getProcessedTags(Player $player): array{
			$member = $this->memFac->getMember($player);
			if(!($member instanceof Member)) return [];
			return [
				"{top_role}"   => $member->getTopRole()->getName(),
				"{roles}" => implode(", ", array_map(function(Role $role): string{
					return $role->getName();
				}, $member->getRoles()))
			];
		}
	}
}
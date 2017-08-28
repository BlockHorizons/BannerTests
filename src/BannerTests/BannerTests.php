<?php

declare(strict_types = 1);

namespace BannerTests;

use pocketmine\block\Block;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\item\Item;
use pocketmine\tile\Banner;
use pocketmine\plugin\PluginBase;

class BannerTests extends PluginBase implements Listener {

	/** @var int */
	protected $patternId = 0;

	public function onEnable() {
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
	}

	public function onInteract(PlayerInteractEvent $event) {
		if($event->getBlock()->getId() === Block::STANDING_BANNER) {
			/** @var Banner $tile */
			$tile = $event->getPlayer()->getLevel()->getTile($event->getBlock());
			switch($event->getItem()->getId()) {
				case Item::APPLE:
					var_dump($tile->namedtag);
					$tile->deleteTopPattern();
					var_dump($tile->namedtag);
					break;
				case Item::SEEDS:
					var_dump($tile->namedtag);
					$tile->deletePattern($this->patternId);
					var_dump($tile->namedtag);
					break;
				case Item::COBWEB:
					var_dump($tile->namedtag);
					$tile->deleteBottomPattern();
					var_dump($tile->namedtag);
					break;
				case Item::BONE:
					var_dump($tile->namedtag);
					$tile->changePattern($this->patternId, Banner::PATTERN_BORDER, 7);
					var_dump($tile->namedtag);
					break;
				case Item::END_STONE:
					var_dump($tile->namedtag);
					$tile->setBaseColor(mt_rand(0, 15));
					var_dump($tile->namedtag);
					break;
				case Item::SPIDER_EYE:
					var_dump($tile->namedtag);
					$this->patternId = $tile->addPattern(Banner::PATTERN_GRADIENT, mt_rand(0, 15));
					var_dump($tile->namedtag);
					break;
			}
		}
	}
}
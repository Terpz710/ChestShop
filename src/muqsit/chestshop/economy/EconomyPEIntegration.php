<?php

declare(strict_types=1);

namespace muqsit\chestshop\economy;

use Closure;
use muqsit\chestshop\util\PlayerIdentity;
use Terpz710\EconomyPE\Money;

final class EconomyPEIntegration implements EconomyIntegration{

	public function init(array $config) : void{
		// noop
	}

	public function getMoney(PlayerIdentity $player, Closure $callback) : void{
		Money::getInstance()->getServer()->getScheduler()->scheduleDelayedTask(new EconomyPETask($player, $callback), 1);
	}

	public function addMoney(PlayerIdentity $player, float $money) : void{
		Money::addMoney($player->getGamertag(), (int) $money);
	}

	public function removeMoney(PlayerIdentity $player, float $money, Closure $callback) : void{
		Money::removeMoney($player->getGamertag(), (int) $money);
	}

	public function formatMoney(float $money): string {
    return number_format($money);
    }
}

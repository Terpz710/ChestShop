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
		Money::getInstance()->getMoneyPlayer($player->getGamertag);
	}

	public function addMoney(PlayerIdentity $player, float $money) : void{
		Money::addMoney($player->getGamertag(), (int) $money);
	}

	public function removeMoney(PlayerIdentity $player, float $money, Closure $callback) : void{
    $balance = Money::getMoneyPlayer($player->getGamertag());

    if ($balance >= $money) {
        Money::removeMoney($player->getGamertag(), (int) $money);
    }
    $callback($balance >= $money);
    }
	
	public function formatMoney(float $money): string {
    return number_format($money);
    }
}

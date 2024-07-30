<?php

interface DiscountHandler
{
	public function setNext(DiscountHandler $handler): void;
	public function handle(float $price): float;
}

class TenPercentHandler implements DiscountHandler
{
	private ?DiscountHandler $nextHandler = null;

	public function setNext(DiscountHandler $handler): void
	{
		$this->nextHandler = $handler;
	}

	public function handle(float $price): float
	{
		if ($price > 100) {
			$discountedPrice = $price * 0.9;
			echo "Desconto de 10% aplicado (preço maior que 100): $discountedPrice\n";
			return $discountedPrice;
		} elseif ($this->nextHandler !== null) {
			return $this->nextHandler->handle($price);
		} else {
			echo "Nenhum desconto aplicável.\n";
			return $price;
		}
	}
}

class FiftyPercentHandler implements DiscountHandler
{
	private ?DiscountHandler $nextHandler = null;

	public function setNext(DiscountHandler $handler): void
	{
		$this->nextHandler = $handler;
	}

	public function handle(float $price): float
	{
		if ($price > 500) {
			$discountedPrice = $price * 0.5;
			echo "Desconto de 50% aplicado (preço maior que 500): $discountedPrice\n";
			return $discountedPrice;
		} elseif ($this->nextHandler !== null) {
			return $this->nextHandler->handle($price);
		} else {
			echo "Nenhum desconto aplicável.\n";
			return $price;
		}
	}
}

$tenPercentHandler = new TenPercentHandler();
$fiftyPercentHandler = new FiftyPercentHandler();

$tenPercentHandler->setNext($fiftyPercentHandler);

$productPrice1 = 120;
echo "Preço original do produto 1: $productPrice1\n";
$discountedPrice1 = $tenPercentHandler->handle($productPrice1);
echo "Preço com desconto do produto 1: $discountedPrice1\n";

echo "---\n";

$productPrice2 = 600;
echo "Preço original do produto 2: $productPrice2\n";
$discountedPrice2 = $tenPercentHandler->handle($productPrice2);
echo "Preço com desconto do produto 2: $discountedPrice2\n";

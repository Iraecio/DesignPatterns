<?php

interface PricingStrategy
{
	public function calculatePrice(float $basePrice): float;
}

class RegularPricingStrategy implements PricingStrategy
{
	public function calculatePrice(float $basePrice): float
	{
		return $basePrice;
	}
}

class DiscountPricingStrategy implements PricingStrategy
{
	private $discountPercentage;

	public function __construct(float $discountPercentage)
	{
		$this->discountPercentage = $discountPercentage;
	}

	public function calculatePrice(float $basePrice): float
	{
		return $basePrice * (1 - $this->discountPercentage / 100);
	}
}

class PromotionalPricingStrategy implements PricingStrategy
{
	private $promotionAmount;

	public function __construct(float $promotionAmount)
	{
		$this->promotionAmount = $promotionAmount;
	}

	public function calculatePrice(float $basePrice): float
	{
		return $basePrice - $this->promotionAmount;
	}
}

class Produto
{
	private $name;
	private $basePrice;
	private $pricingStrategy;

	public function __construct(string $name, float $basePrice, PricingStrategy $pricingStrategy)
	{
		$this->name = $name;
		$this->basePrice = $basePrice;
		$this->pricingStrategy = $pricingStrategy;
	}

	public function setPricingStrategy(PricingStrategy $pricingStrategy): void
	{
		$this->pricingStrategy = $pricingStrategy;
	}

	public function calculatePrice(): float
	{
		return $this->pricingStrategy->calculatePrice($this->basePrice);
	}

	public function getName(): string
	{
		return $this->name;
	}
}

// Exemplo de uso
$regularPricing = new RegularPricingStrategy();
$discountPricing = new DiscountPricingStrategy(10);
$promotionalPricing = new PromotionalPricingStrategy(5);

$produto1 = new Produto('Produto 1', 100, $regularPricing);
echo $produto1->getName() . " preço: " . $produto1->calculatePrice() . "\n";

$produto2 = new Produto('Produto 2', 100, $discountPricing);
echo $produto2->getName() . " preço: " . $produto2->calculatePrice() . "\n";

$produto3 = new Produto('Produto 3', 100, $promotionalPricing);
echo $produto3->getName() . " preço: " . $produto3->calculatePrice() . "\n";

$produto1->setPricingStrategy($discountPricing);
echo $produto1->getName() . " preço com desconto: " . $produto1->calculatePrice() . "\n";

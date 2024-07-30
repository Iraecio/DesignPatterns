<?php

interface Discount
{
	public function apply(float $price): float;
}

class PercentageDiscount implements Discount
{
	private $percentage;

	public function __construct(float $percentage)
	{
		$this->percentage = $percentage;
	}

	public function apply(float $price): float
	{
		return $price - ($price * $this->percentage / 100);
	}
}

class FixedDiscount implements Discount
{
	private $amount;

	public function __construct(float $amount)
	{
		$this->amount = $amount;
	}

	public function apply(float $price): float
	{
		return $price - $this->amount;
	}
}

abstract class Product
{
	protected $discount;
	protected $name;
	protected $price;

	public function __construct(string $name, float $price, Discount $discount)
	{
		$this->name = $name;
		$this->price = $price;
		$this->discount = $discount;
	}

	abstract public function getPrice(): float;

	public function getName(): string
	{
		return $this->name;
	}

	public function setDiscount(Discount $discount): void
	{
		$this->discount = $discount;
	}
}

class PhysicalProduct extends Product
{
	public function getPrice(): float
	{
		return $this->discount->apply($this->price);
	}
}

class DigitalProduct extends Product
{
	public function getPrice(): float
	{
		return $this->discount->apply($this->price);
	}
}

$fixedDiscount = new FixedDiscount(20.0);
$percentageDiscount = new PercentageDiscount(10.0);

$physicalProduct = new PhysicalProduct('Produto Físico', 100.0, $fixedDiscount);
$digitalProduct = new DigitalProduct('Produto Digital', 50.0, $percentageDiscount);

echo $physicalProduct->getName() . ' - Preço com desconto: ' . $physicalProduct->getPrice() . "\n";
echo $digitalProduct->getName() . ' - Preço com desconto: ' . $digitalProduct->getPrice() . "\n";

$physicalProduct->setDiscount($percentageDiscount);
echo $physicalProduct->getName() . ' - Preço com novo desconto: ' . $physicalProduct->getPrice() . "\n";

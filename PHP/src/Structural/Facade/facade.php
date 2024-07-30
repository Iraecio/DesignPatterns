<?php

class Inventory
{
	private $stock = [];

	public function addProduct(string $name, int $quantity): void
	{
		if (!isset($this->stock[$name])) {
			$this->stock[$name] = 0;
		}
		$this->stock[$name] += $quantity;
		echo "Adicionado $quantity unidades de $name ao inventário.\n";
	}

	public function removeProduct(string $name, int $quantity): void
	{
		if (isset($this->stock[$name]) && $this->stock[$name] >= $quantity) {
			$this->stock[$name] -= $quantity;
			echo "Removido $quantity unidades de $name do inventário.\n";
		} else {
			echo "Estoque insuficiente para remover $quantity unidades de $name.\n";
		}
	}

	public function getStock(string $name): int
	{
		return $this->stock[$name] ?? 0;
	}
}

class Pricing
{
	private $prices = [];

	public function setPrice(string $name, float $price): void
	{
		$this->prices[$name] = $price;
		echo "O preço de $name foi definido para R$$price.\n";
	}

	public function getPrice(string $name): float
	{
		return $this->prices[$name] ?? 0;
	}
}

class Shipping
{
	public function shipProduct(string $name, int $quantity): void
	{
		echo "Enviando $quantity unidades de $name.\n";
	}
}

class ProductFacade
{
	private $inventory;
	private $pricing;
	private $shipping;

	public function __construct()
	{
		$this->inventory = new Inventory();
		$this->pricing = new Pricing();
		$this->shipping = new Shipping();
	}

	public function addProduct(string $name, int $quantity, float $price): void
	{
		$this->inventory->addProduct($name, $quantity);
		$this->pricing->setPrice($name, $price);
	}

	public function shipProduct(string $name, int $quantity): void
	{
		if ($this->inventory->getStock($name) >= $quantity) {
			$this->shipping->shipProduct($name, $quantity);
			$this->inventory->removeProduct($name, $quantity);
		} else {
			echo "Estoque insuficiente para enviar $quantity unidades de $name.\n";
		}
	}

	public function getProductInfo(string $name): void
	{
		$stock = $this->inventory->getStock($name);
		$price = $this->pricing->getPrice($name);
		echo "Produto: $name, Estoque: $stock, Preço: R$$price\n";
	}
}

$productFacade = new ProductFacade();

$productFacade->addProduct('Produto A', 100, 50);
$productFacade->addProduct('Produto B', 200, 30);
$productFacade->getProductInfo('Produto A');
$productFacade->getProductInfo('Produto B');
$productFacade->shipProduct('Produto A', 20);
$productFacade->shipProduct('Produto B', 50);
$productFacade->getProductInfo('Produto A');
$productFacade->getProductInfo('Produto B');

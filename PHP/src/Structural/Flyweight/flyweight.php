<?php

interface Product
{
	public function getCategory(): string;
	public function getManufacturer(): string;
	public function getName(): string;
	public function getPrice(): float;
}

class ProductFlyweight
{
	private $category;
	private $manufacturer;

	public function __construct(string $category, string $manufacturer)
	{
		$this->category = $category;
		$this->manufacturer = $manufacturer;
	}

	public function getCategory(): string
	{
		return $this->category;
	}

	public function getManufacturer(): string
	{
		return $this->manufacturer;
	}
}

class ConcreteProduct implements Product
{
	private $name;
	private $price;
	private $flyweight;

	public function __construct(string $name, float $price, ProductFlyweight $flyweight)
	{
		$this->name = $name;
		$this->price = $price;
		$this->flyweight = $flyweight;
	}

	public function getCategory(): string
	{
		return $this->flyweight->getCategory();
	}

	public function getManufacturer(): string
	{
		return $this->flyweight->getManufacturer();
	}

	public function getName(): string
	{
		return $this->name;
	}

	public function getPrice(): float
	{
		return $this->price;
	}
}

class FlyweightFactory
{
	private $flyweights = [];

	public function getFlyweight(string $category, string $manufacturer): ProductFlyweight
	{
		$key = $category . '_' . $manufacturer;
		if (!isset($this->flyweights[$key])) {
			$this->flyweights[$key] = new ProductFlyweight($category, $manufacturer);
		}
		return $this->flyweights[$key];
	}

	public function getCount(): int
	{
		return count($this->flyweights);
	}
}

$flyweightFactory = new FlyweightFactory();

$product1 = new ConcreteProduct('Produto A', 100.0, $flyweightFactory->getFlyweight('Eletrônicos', 'Samsung'));
$product2 = new ConcreteProduct('Produto B', 200.0, $flyweightFactory->getFlyweight('Eletrônicos', 'Samsung'));
$product3 = new ConcreteProduct('Produto C', 150.0, $flyweightFactory->getFlyweight('Eletrodomésticos', 'LG'));

echo $product1->getName() . ' - Categoria: ' . $product1->getCategory() . ', Fabricante: ' . $product1->getManufacturer() . ', Preço: R$' . $product1->getPrice() . "\n";
echo $product2->getName() . ' - Categoria: ' . $product2->getCategory() . ', Fabricante: ' . $product2->getManufacturer() . ', Preço: R$' . $product2->getPrice() . "\n";
echo $product3->getName() . ' - Categoria: ' . $product3->getCategory() . ', Fabricante: ' . $product3->getManufacturer() . ', Preço: R$' . $product3->getPrice() . "\n";

echo 'Quantidade de flyweights criados: ' . $flyweightFactory->getCount() . "\n";

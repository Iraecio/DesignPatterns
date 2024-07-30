<?php

interface Visitor
{
	public function visitProductA(ProductA $product): void;
	public function visitProductB(ProductB $product): void;
}

interface Element
{
	public function accept(Visitor $visitor): void;
}

class ProductA implements Element
{
	private $name;
	private $price;

	public function __construct(string $name, float $price)
	{
		$this->name = $name;
		$this->price = $price;
	}

	public function getName(): string
	{
		return $this->name;
	}

	public function getPrice(): float
	{
		return $this->price;
	}

	public function accept(Visitor $visitor): void
	{
		$visitor->visitProductA($this);
	}
}

class ProductB implements Element
{
	private $name;
	private $stock;

	public function __construct(string $name, int $stock)
	{
		$this->name = $name;
		$this->stock = $stock;
	}

	public function getName(): string
	{
		return $this->name;
	}

	public function getStock(): int
	{
		return $this->stock;
	}

	public function accept(Visitor $visitor): void
	{
		$visitor->visitProductB($this);
	}
}

class ConcreteVisitor implements Visitor
{
	public function visitProductA(ProductA $product): void
	{
		echo "Visitor está processando " . $product->getName() . " com preço " . $product->getPrice() . "\n";
	}

	public function visitProductB(ProductB $product): void
	{
		echo "Visitor está processando " . $product->getName() . " com estoque " . $product->getStock() . "\n";
	}
}

// Exemplo de uso
$productA = new ProductA('Produto A', 100);
$productB = new ProductB('Produto B', 50);
$visitor = new ConcreteVisitor();

$productA->accept($visitor);
$productB->accept($visitor);

<?php

interface Command
{
	public function execute();
}

class ChangePriceCommand implements Command
{
	private $product;
	private $newPrice;

	public function __construct(Product $product, $newPrice)
	{
		$this->product = $product;
		$this->newPrice = $newPrice;
	}

	public function execute()
	{
		echo "Alterando o preço do produto " . $this->product->getName() . " para " . $this->newPrice . "\n";
		$this->product->setPrice($this->newPrice);
	}
}

class AddStockCommand implements Command
{
	private $product;
	private $quantity;

	public function __construct(Product $product, $quantity)
	{
		$this->product = $product;
		$this->quantity = $quantity;
	}

	public function execute()
	{
		echo "Adicionando " . $this->quantity . " unidades ao estoque do produto " . $this->product->getName() . "\n";
		$this->product->addStock($this->quantity);
	}
}

class Product
{
	private $name;
	private $price;
	private $stock;

	public function __construct($name, $price, $stock)
	{
		$this->name = $name;
		$this->price = $price;
		$this->stock = $stock;
	}

	public function getName()
	{
		return $this->name;
	}

	public function setPrice($newPrice)
	{
		$this->price = $newPrice;
		echo "Novo preço definido para " . $this->price . "\n";
	}

	public function getPrice()
	{
		return $this->price;
	}

	public function addStock($quantity)
	{
		$this->stock += $quantity;
		echo "Estoque atualizado para " . $this->stock . "\n";
	}
}

// Criando um produto
$product = new Product('Produto A', 100, 50);

// Comandos
$changePriceCommand = new ChangePriceCommand($product, 120);
$addStockCommand = new AddStockCommand($product, 20);

// Executando os comandos
$changePriceCommand->execute();
$addStockCommand->execute();

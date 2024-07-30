<?php

interface IOldProduct
{
	public function getName(): string;
	public function getPrice(): float;
}

class OldProduct implements IOldProduct
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
}

class NewProduct
{
	private $productName;
	private $productPrice;

	public function __construct(string $productName, float $productPrice)
	{
		$this->productName = $productName;
		$this->productPrice = $productPrice;
	}

	public function getProductName(): string
	{
		return $this->productName;
	}

	public function getProductPrice(): float
	{
		return $this->productPrice;
	}
}

class ProductAdapter implements IOldProduct
{
	private $newProduct;

	public function __construct(NewProduct $newProduct)
	{
		$this->newProduct = $newProduct;
	}

	public function getName(): string
	{
		return $this->newProduct->getProductName();
	}

	public function getPrice(): float
	{
		return $this->newProduct->getProductPrice();
	}
}

function displayProduct(IOldProduct $product)
{
	echo 'Nome do Produto: ' . $product->getName() . "\n";
	echo 'Preço do Produto: ' . $product->getPrice() . "\n";
}

// Testando o Adapter
$oldProduct = new OldProduct('Produto Antigo', 100.0);
$newProduct = new NewProduct('Produto Novo', 150.0);

displayProduct($oldProduct);

$adaptedProduct = new ProductAdapter($newProduct);
displayProduct($adaptedProduct);

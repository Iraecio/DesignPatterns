<?php

interface IteratorInterface
{
	public function next();
	public function hasNext();
}

interface IterableCollection
{
	public function createIterator(): IteratorInterface;
}

class ProductIterator implements IteratorInterface
{
	private $collection;
	private $position = 0;

	public function __construct($collection)
	{
		$this->collection = $collection;
	}

	public function next()
	{
		$product = $this->collection[$this->position];
		$this->position++;
		return $product;
	}

	public function hasNext()
	{
		return $this->position < count($this->collection);
	}
}

class ProductCollection implements IterableCollection
{
	private $products = [];

	public function addProduct(Product $product)
	{
		$this->products[] = $product;
	}

	public function createIterator(): IteratorInterface
	{
		return new ProductIterator($this->products);
	}
}

class Product
{
	private $name;
	private $price;

	public function __construct($name, $price)
	{
		$this->name = $name;
		$this->price = $price;
	}

	public function getName()
	{
		return $this->name;
	}

	public function getPrice()
	{
		return $this->price;
	}
}

// Criando a coleção de produtos
$collection = new ProductCollection();

$collection->addProduct(new Product('Produto A', 100));
$collection->addProduct(new Product('Produto B', 150));
$collection->addProduct(new Product('Produto C', 200));

// Criando o iterador
$iterator = $collection->createIterator();

echo "Iterando sobre os produtos:\n";
while ($iterator->hasNext()) {
	$product = $iterator->next();
	echo $product->getName() . " - Preço: " . $product->getPrice() . "\n";
}

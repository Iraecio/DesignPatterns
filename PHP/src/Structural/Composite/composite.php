<?php

abstract class Component
{
	protected $parent = null;

	public function add(Component $component): void
	{
	}

	public function remove(Component $component): void
	{
	}

	public function getParent(): ?Component
	{
		return $this->parent;
	}

	public function setParent(Component $parent): void
	{
		$this->parent = $parent;
	}

	abstract public function getPrice(): float;
}

class Product extends Component
{
	private $price;

	public function __construct(float $price)
	{
		$this->price = $price;
	}

	public function getPrice(): float
	{
		return $this->price;
	}
}

class Composite extends Component
{
	private $children = [];

	public function add(Component $component): void
	{
		$this->children[] = $component;
		$component->setParent($this);
	}

	public function remove(Component $component): void
	{
		$index = array_search($component, $this->children, true);
		if ($index !== false) {
			array_splice($this->children, $index, 1);
		}
	}

	public function getPrice(): float
	{
		$total = 0;
		foreach ($this->children as $child) {
			$total += $child->getPrice();
		}
		return $total;
	}
}

class ShoppingCart
{
	private $root;

	public function __construct()
	{
		$this->root = new Composite();
	}

	public function addProduct(Component $product): void
	{
		$this->root->add($product);
	}

	public function removeProduct(Component $product): void
	{
		$this->root->remove($product);
	}

	public function getTotalPrice(): float
	{
		return $this->root->getPrice();
	}
}

class Demo
{
	public static function main(): void
	{
		$shoppingCart = new ShoppingCart();

		$product1 = new Product(10.0);
		$product2 = new Product(20.0);
		$product3 = new Product(30.0);

		$shoppingCart->addProduct($product1);
		$shoppingCart->addProduct($product2);
		$shoppingCart->addProduct($product3);

		$composite = new Composite();
		$composite->add($product1);
		$composite->add($product2);

		$shoppingCart->addProduct($composite);

		echo 'Total price: ' . $shoppingCart->getTotalPrice() . "\n";

		$shoppingCart->removeProduct($product2);

		echo 'Total price after removing product2: ' . $shoppingCart->getTotalPrice() . "\n";
	}
}

Demo::main();

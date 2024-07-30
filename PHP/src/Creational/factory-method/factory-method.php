<?php

abstract class ProductFactory
{
	abstract public function createProduct(): Product;

	public function deliverProduct(): string
	{
		$product = $this->createProduct();
		return 'Delivering ' . $product->deliver();
	}
}

class TechProductFactory extends ProductFactory
{
	public function createProduct(): Product
	{
		return new TechProduct();
	}
}

class FoodProductFactory extends ProductFactory
{
	public function createProduct(): Product
	{
		return new FoodProduct();
	}
}

interface Product
{
	public function deliver(): string;
}

class TechProduct implements Product
{
	public function deliver(): string
	{
		return 'Tech product delivery with postal';
	}
}

class FoodProduct implements Product
{
	public function deliver(): string
	{
		return 'Food product delivery with motoboy';
	}
}

class Demo
{
	public static function main(): void
	{
		$factories = [new TechProductFactory(), new FoodProductFactory()];

		foreach ($factories as $factory) {
			echo $factory->deliverProduct() . "\n";
		}
	}
}

Demo::main();

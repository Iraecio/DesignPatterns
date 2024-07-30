<?php

interface Product
{
	public function getDescription(): string;
	public function getPrice(): float;
}

class BasicProduct implements Product
{
	private $name;
	private $price;

	public function __construct(string $name, float $price)
	{
		$this->name = $name;
		$this->price = $price;
	}

	public function getDescription(): string
	{
		return $this->name;
	}

	public function getPrice(): float
	{
		return $this->price;
	}
}

abstract class ProductDecorator implements Product
{
	protected $product;

	public function __construct(Product $product)
	{
		$this->product = $product;
	}

	abstract public function getDescription(): string;
	abstract public function getPrice(): float;
}

class GiftWrapDecorator extends ProductDecorator
{
	public function getDescription(): string
	{
		return $this->product->getDescription() . ', com embalagem de presente';
	}

	public function getPrice(): float
	{
		return $this->product->getPrice() + 5.0;
	}
}

class ExtendedWarrantyDecorator extends ProductDecorator
{
	public function getDescription(): string
	{
		return $this->product->getDescription() . ', com garantia estendida';
	}

	public function getPrice(): float
	{
		return $this->product->getPrice() + 20.0;
	}
}

$product = new BasicProduct('Produto A', 100.0);
echo $product->getDescription() . ' - Preço: R$' . $product->getPrice() . "\n";

$giftWrappedProduct = new GiftWrapDecorator($product);
echo $giftWrappedProduct->getDescription() . ' - Preço: R$' . $giftWrappedProduct->getPrice() . "\n";

$fullyFeaturedProduct = new ExtendedWarrantyDecorator($giftWrappedProduct);
echo $fullyFeaturedProduct->getDescription() . ' - Preço: R$' . $fullyFeaturedProduct->getPrice() . "\n";

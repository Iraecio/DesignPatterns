<?php

interface Product
{
	public function getName(): string;
	public function getPrice(): float;
}

class RealProduct implements Product
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
		echo 'Chamando getName do RealProduct' . PHP_EOL;
		return $this->name;
	}

	public function getPrice(): float
	{
		echo 'Chamando getPrice do RealProduct' . PHP_EOL;
		return $this->price;
	}
}

class ProductProxy implements Product
{
	private $realProduct;
	private $cachedName;
	private $cachedPrice;

	public function __construct(RealProduct $realProduct)
	{
		$this->realProduct = $realProduct;
		$this->cachedName = null;
		$this->cachedPrice = null;
	}

	public function getName(): string
	{
		if ($this->cachedName === null) {
			echo 'Cache vazio, chamando getName do RealProduct' . PHP_EOL;
			$this->cachedName = $this->realProduct->getName();
		} else {
			echo 'Retornando nome do cache' . PHP_EOL;
		}
		return $this->cachedName;
	}

	public function getPrice(): float
	{
		if ($this->cachedPrice === null) {
			echo 'Cache vazio, chamando getPrice do RealProduct' . PHP_EOL;
			$this->cachedPrice = $this->realProduct->getPrice();
		} else {
			echo 'Retornando preço do cache' . PHP_EOL;
		}
		return $this->cachedPrice;
	}
}

$realProduct = new RealProduct('Produto A', 100.0);

$productProxy = new ProductProxy($realProduct);

echo $productProxy->getName() . PHP_EOL;
echo $productProxy->getPrice() . PHP_EOL;

echo $productProxy->getName() . PHP_EOL;
echo $productProxy->getPrice() . PHP_EOL;

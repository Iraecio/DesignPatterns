<?php

abstract class PedidoBuilder
{
	abstract public function makeCliente(): self;
	abstract public function makeProduto(): self;
	abstract public function makeQuantidade(): self;
	abstract public function makePrice(): self;
	abstract public function makeTotal(): self;
	abstract public function build(): Pedido;
}

class Pedido
{
	public $cliente = '';
	public $produto = '';
	public $quantidade = 0;
	public $price = 0;
	public $total = 0;
}

class PedidoBuilderImpl extends PedidoBuilder
{
	private $pedido;

	public function __construct()
	{
		$this->pedido = new Pedido();
	}

	public function makeCliente(): self
	{
		$this->pedido->cliente = 'Cliente 1';
		return $this;
	}

	public function makeProduto(): self
	{
		$this->pedido->produto = 'Produto 1';
		return $this;
	}

	public function makeQuantidade(): self
	{
		$this->pedido->quantidade = 10;
		return $this;
	}

	public function makePrice(): self
	{
		$this->pedido->price = 100;
		return $this;
	}

	public function makeTotal(): self
	{
		$this->pedido->total = $this->pedido->quantidade * $this->pedido->price;
		return $this;
	}

	public function build(): Pedido
	{
		return $this->pedido;
	}

	public function toString(): string
	{
		return json_encode($this->pedido);
	}
}

class Demo
{
	public static function main(): void
	{
		$builder = new PedidoBuilderImpl();
		$builder->makeCliente()
			->makeProduto()
			->makeQuantidade()
			->makePrice()
			->makeTotal();
		echo $builder->toString() . "\n";
	}
}

Demo::main();

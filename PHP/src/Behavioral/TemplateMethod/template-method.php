<?php

abstract class HotBeverage
{
	public function prepareBeverage(): void
	{
		$this->boilWater();
		$this->brew();
		$this->pourInCup();
		$this->addCondiments();
	}

	abstract protected function brew(): void;
	abstract protected function addCondiments(): void;

	protected function boilWater(): void
	{
		echo "Fervendo água\n";
	}

	protected function pourInCup(): void
	{
		echo "Despejando a bebida na xícara\n";
	}
}

class Tea extends HotBeverage
{
	protected function brew(): void
	{
		echo "Infundindo o chá\n";
	}

	protected function addCondiments(): void
	{
		echo "Adicionando limão\n";
	}
}

class Coffee extends HotBeverage
{
	protected function brew(): void
	{
		echo "Passando café\n";
	}

	protected function addCondiments(): void
	{
		echo "Adicionando açúcar e leite\n";
	}
}

// Exemplo de uso
$tea = new Tea();
echo "Preparando chá:\n";
$tea->prepareBeverage();

echo "---\n";

$coffee = new Coffee();
echo "Preparando café:\n";
$coffee->prepareBeverage();

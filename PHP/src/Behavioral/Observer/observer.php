<?php

interface Observer
{
	public function update(string $message): void;
}

interface Observable
{
	public function addObserver(Observer $observer): void;
	public function removeObserver(Observer $observer): void;
	public function notifyObservers(string $message): void;
}

class Product implements Observable
{
	private $observers = [];
	private $name;
	private $price;

	public function __construct(string $name, float $price)
	{
		$this->name = $name;
		$this->price = $price;
	}

	public function addObserver(Observer $observer): void
	{
		$this->observers[] = $observer;
	}

	public function removeObserver(Observer $observer): void
	{
		$index = array_search($observer, $this->observers);
		if ($index !== false) {
			unset($this->observers[$index]);
			$this->observers = array_values($this->observers); // Reindex array
		}
	}

	public function notifyObservers(string $message): void
	{
		foreach ($this->observers as $observer) {
			$observer->update($message);
		}
	}

	public function setPrice(float $price): void
	{
		$this->price = $price;
		$this->notifyObservers("O preço do {$this->name} foi atualizado para {$this->price}");
	}

	public function getPrice(): float
	{
		return $this->price;
	}
}

class User implements Observer
{
	private $name;

	public function __construct(string $name)
	{
		$this->name = $name;
	}

	public function update(string $message): void
	{
		echo "{$this->name} recebeu a notificação: {$message}\n";
	}
}

// Exemplo de uso
$produto = new Product('Produto A', 100);

$user1 = new User('João');
$user2 = new User('Maria');

$produto->addObserver($user1);
$produto->addObserver($user2);

$produto->setPrice(120);
$produto->setPrice(150);

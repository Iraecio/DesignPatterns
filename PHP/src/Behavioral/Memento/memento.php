<?php

interface Memento
{
	public function getState();
	public function getName(): string;
	public function getDate(): string;
}

class ProductMemento implements Memento
{
	private $state;
	private $date;

	public function __construct($state)
	{
		$this->state = $state;
		$this->date = (new DateTime())->format(DateTime::ATOM);
	}

	public function getState()
	{
		return $this->state;
	}

	public function getName(): string
	{
		return "Memento ({$this->date})";
	}

	public function getDate(): string
	{
		return $this->date;
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

	public function setName($name): void
	{
		$this->name = $name;
	}

	public function setPrice($price): void
	{
		$this->price = $price;
	}

	public function setStock($stock): void
	{
		$this->stock = $stock;
	}

	public function save(): Memento
	{
		return new ProductMemento([
			'name' => $this->name,
			'price' => $this->price,
			'stock' => $this->stock,
		]);
	}

	public function restore(Memento $memento): void
	{
		$state = $memento->getState();
		$this->name = $state['name'];
		$this->price = $state['price'];
		$this->stock = $state['stock'];
	}

	public function getName(): string
	{
		return $this->name;
	}

	public function getPrice(): float
	{
		return $this->price;
	}

	public function getStock(): int
	{
		return $this->stock;
	}

	public function getDetails(): string
	{
		return "Produto: {$this->name}, Preço: {$this->price}, Estoque: {$this->stock}";
	}
}

class Caretaker
{
	private $mementos = [];
	private $originator;

	public function __construct($originator)
	{
		$this->originator = $originator;
	}

	public function backup(): void
	{
		echo "Caretaker: Salvando o estado do Originator...\n";
		$this->mementos[] = $this->originator->save();
	}

	public function undo(): void
	{
		if (!count($this->mementos)) {
			return;
		}
		$memento = array_pop($this->mementos);
		echo "Caretaker: Restaurando o estado para: " . $memento->getName() . "\n";
		$this->originator->restore($memento);
	}

	public function showHistory(): void
	{
		echo "Caretaker: Aqui está o histórico de mementos:\n";
		foreach ($this->mementos as $memento) {
			echo $memento->getName() . "\n";
		}
	}
}

// Exemplo de uso
$product = new Product('Produto A', 100, 50);
$caretaker = new Caretaker($product);

$caretaker->backup();
echo $product->getDetails() . "\n";

$product->setName('Produto B');
$product->setPrice(150);
$product->setStock(30);
echo $product->getDetails() . "\n";

$caretaker->backup();

$product->setName('Produto C');
$product->setPrice(200);
$product->setStock(20);
echo $product->getDetails() . "\n";

$caretaker->undo();
echo $product->getDetails() . "\n";

$caretaker->undo();
echo $product->getDetails() . "\n";

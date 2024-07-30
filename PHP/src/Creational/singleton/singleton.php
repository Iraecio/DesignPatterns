<?php

interface IDados
{
	public function getId(): int;
	public function getNome(): string;
}

class Dado implements IDados
{
	private $id;
	private $nome;

	public function __construct(int $id, string $nome)
	{
		$this->id = $id;
		$this->nome = $nome;
	}

	public function getId(): int
	{
		return $this->id;
	}

	public function getNome(): string
	{
		return $this->nome;
	}
}

class Singleton
{
	private static $instancia = null;
	private $dados = [];

	private function __construct()
	{
		// Esconde o construtor padrão
	}

	public static function obterInstancia(): Singleton
	{
		if (self::$instancia === null) {
			self::$instancia = new Singleton();
		}
		return self::$instancia;
	}

	public function criaDado(int $id, string $nome): void
	{
		$this->dados[] = new Dado($id, $nome);
	}

	public function removeDado(int $index): void
	{
		if (isset($this->dados[$index])) {
			unset($this->dados[$index]);
			$this->dados = array_values($this->dados); // Reindexa o array
		}
	}

	public function mostraDados(): array
	{
		return $this->dados;
	}
}

// Testando o Singleton
$singleton1 = Singleton::obterInstancia();
$singleton1->criaDado(1, 'dado1');

$singleton2 = Singleton::obterInstancia();
$singleton2->criaDado(2, 'dado2');

// O Singleton deve ter os mesmos dados
$dados = Singleton::obterInstancia()->mostraDados();

foreach ($dados as $dado) {
	echo 'ID: ' . $dado->getId() . ', Nome: ' . $dado->getNome() . "\n";
}

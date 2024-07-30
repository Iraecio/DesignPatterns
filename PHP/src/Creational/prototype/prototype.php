<?php

class Produto
{
	private $nome;
	private $preco;

	public function __construct(string $nome, float $preco)
	{
		$this->nome = $nome;
		$this->preco = $preco;
	}

	public function clone(): Produto
	{
		return new Produto($this->nome, $this->preco);
	}

	public function getNome(): string
	{
		return $this->nome;
	}

	public function setNome(string $nome): void
	{
		$this->nome = $nome;
	}

	public function getPreco(): float
	{
		return $this->preco;
	}

	public function setPreco(float $preco): void
	{
		$this->preco = $preco;
	}
}

// Criando um produto original
$produtoOriginal = new Produto('Camiseta', 50.0);

// Clonando o produto
$produtoClone = $produtoOriginal->clone();

// Modificando o clone
$produtoClone->setNome('Camiseta com estampa');
$produtoClone->setPreco(60.0);

// Exibindo detalhes dos produtos
echo "Produto Original: " . $produtoOriginal->getNome() . " - " . $produtoOriginal->getPreco() . " Reais\n";
echo "Produto Clone: " . $produtoClone->getNome() . " - " . $produtoClone->getPreco() . " Reais\n";

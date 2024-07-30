<?php

interface PackageState
{
	public function updateState(PackageContext $context): void;
}

class PendingState implements PackageState
{
	public function updateState(PackageContext $context): void
	{
		echo "A encomenda está pendente de envio.\n";
		$context->setState(new ShippedState());
	}
}

class ShippedState implements PackageState
{
	public function updateState(PackageContext $context): void
	{
		echo "A encomenda foi enviada.\n";
		$context->setState(new DeliveredState());
	}
}

class DeliveredState implements PackageState
{
	public function updateState(PackageContext $context): void
	{
		echo "A encomenda foi entregue com sucesso.\n";
	}
}

class PackageContext
{
	private $state;

	public function __construct()
	{
		$this->state = new PendingState();
	}

	public function setState(PackageState $state): void
	{
		$this->state = $state;
	}

	public function update(): void
	{
		$this->state->updateState($this);
	}
}

// Exemplo de uso
$packageContext = new PackageContext();

$packageContext->update();
$packageContext->update();
$packageContext->update();

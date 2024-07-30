<?php

interface Button
{
	public function paint(): void;
}

interface Checkbox
{
	public function paint(): void;
}

class DarkButton implements Button
{
	public function paint(): void
	{
		echo "Rendering a dark-themed button.\n";
	}
}

class DarkCheckbox implements Checkbox
{
	public function paint(): void
	{
		echo "Rendering a dark-themed checkbox.\n";
	}
}

class LightButton implements Button
{
	public function paint(): void
	{
		echo "Rendering a light-themed button.\n";
	}
}

class LightCheckbox implements Checkbox
{
	public function paint(): void
	{
		echo "Rendering a light-themed checkbox.\n";
	}
}

interface UIFactory
{
	public function createButton(): Button;
	public function createCheckbox(): Checkbox;
}

class DarkUIFactory implements UIFactory
{
	public function createButton(): Button
	{
		return new DarkButton();
	}

	public function createCheckbox(): Checkbox
	{
		return new DarkCheckbox();
	}
}

class LightUIFactory implements UIFactory
{
	public function createButton(): Button
	{
		return new LightButton();
	}

	public function createCheckbox(): Checkbox
	{
		return new LightCheckbox();
	}
}

function configureUI(UIFactory $factory): void
{
	$button = $factory->createButton();
	$checkbox = $factory->createCheckbox();

	$button->paint();
	$checkbox->paint();
}

// Exemplo de uso
$isDarkTheme = true;

$factory = $isDarkTheme ? new DarkUIFactory() : new LightUIFactory();
configureUI($factory);

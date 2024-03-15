<?php

use DI\ContainerBuilder;
use League\Plates\Engine;
use Psr\Container\ContainerInterface;
use Xlucaspx\PhpWebSerenatto\Domain\Repository\ProductRepository;
use Xlucaspx\PhpWebSerenatto\Domain\Repository\TypeRepository;
use Xlucaspx\PhpWebSerenatto\Infra\Connection\ConnectionFactory;
use Xlucaspx\PhpWebSerenatto\Infra\Repository\PdoProductRepository;
use Xlucaspx\PhpWebSerenatto\Infra\Repository\PdoTypeRepository;
use function DI\autowire;

$builder = new ContainerBuilder();
$builder->addDefinitions([
	PDO::class => function (): PDO {
		return ConnectionFactory::getConnection();
	},
	Engine::class => function () {
		$templatePath = __DIR__ . '/../views';
		return new Engine($templatePath); // default ext: .php
	},
	ProductRepository::class => autowire(PdoProductRepository::class),
	TypeRepository::class => autowire(PdoTypeRepository::class)
]);

/** @var ContainerInterface $container */
$container = $builder->build();

return $container;

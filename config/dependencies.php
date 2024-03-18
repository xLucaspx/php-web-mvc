<?php

use DI\ContainerBuilder;
use League\Plates\Engine;
use Psr\Container\ContainerInterface;
use Xlucaspx\PhpWebSerenatto\Domain\Repository\{ProductRepository, TypeRepository, UserRepository};
use Xlucaspx\PhpWebSerenatto\Infra\Connection\ConnectionFactory;
use Xlucaspx\PhpWebSerenatto\Infra\Repository\{PdoProductRepository, PdoTypeRepository, PdoUserRepository};
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
	TypeRepository::class => autowire(PdoTypeRepository::class),
	UserRepository::class => autowire(PdoUserRepository::class)
]);

/** @var ContainerInterface $container */
$container = $builder->build();

return $container;

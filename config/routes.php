<?php

declare(strict_types=1);

use Xlucaspx\PhpWebSerenatto\Infra\Controller\AdminController;
use Xlucaspx\PhpWebSerenatto\Infra\Controller\HomepageController;
use Xlucaspx\PhpWebSerenatto\Infra\Controller\Product\{
	DeleteProductController,
	EditProductController,
	NewProductController,
	ProductFormController
};
use Xlucaspx\PhpWebSerenatto\Infra\Controller\Type\{
	DeleteTypeController,
	EditTypeController,
	NewTypeController
};

return [
	'GET|/' => HomepageController::class,

	'GET|/admin' => AdminController::class,

	'GET|/novo-produto' => ProductFormController::class,
	'POST|/novo-produto' => NewProductController::class,

	'GET|/editar-produto' => ProductFormController::class,
	'POST|/editar-produto' => EditProductController::class,

	'DELETE|/remover-produto' => DeleteProductController::class,

	'POST|/novo-tipo' => NewTypeController::class,
	'PUT|/editar-tipo' => EditTypeController::class,
	'DELETE|/remover-tipo' => DeleteTypeController::class,
];

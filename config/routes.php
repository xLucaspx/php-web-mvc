<?php

declare(strict_types=1);

use Xlucaspx\PhpWebSerenatto\Infra\Controller\{AdminController, HomepageController,};
use Xlucaspx\PhpWebSerenatto\Infra\Controller\Login\{LoginController, LoginFormController, LogoutController};
use Xlucaspx\PhpWebSerenatto\Infra\Controller\Product\{DeleteProductController,
	EditProductController,
	NewProductController,
	ProductFormController};
use Xlucaspx\PhpWebSerenatto\Infra\Controller\Type\{DeleteTypeController, EditTypeController, NewTypeController};

return [
	'GET|/' => HomepageController::class,
	'GET|/login' => LoginFormController::class,
	'POST|/login' => LoginController::class,
	'GET|/logout' => LogoutController::class,
	'GET|/admin' => AdminController::class,
	// products
	'GET|/novo-produto' => ProductFormController::class,
	'POST|/novo-produto' => NewProductController::class,
	'GET|/editar-produto' => ProductFormController::class,
	'POST|/editar-produto' => EditProductController::class,
	'DELETE|/remover-produto' => DeleteProductController::class,
	// types
	'POST|/novo-tipo' => NewTypeController::class,
	'PUT|/editar-tipo' => EditTypeController::class,
	'DELETE|/remover-tipo' => DeleteTypeController::class,
];

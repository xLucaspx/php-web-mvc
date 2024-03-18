<?php

declare(strict_types=1);

use Nyholm\Psr7\Factory\Psr17Factory;
use Nyholm\Psr7Server\ServerRequestCreator;
use Psr\Container\ContainerInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Xlucaspx\PhpWebSerenatto\Infra\Controller\Error404Controller;

require_once __DIR__ . '/../vendor/autoload.php';

$routes = require_once __DIR__ . '/../config/routes.php';
/** @var ContainerInterface $diContainer */
$diContainer = require_once __DIR__ . '/../config/dependencies.php';

$httpMethod = $_SERVER['REQUEST_METHOD'];
$pathInfo = $_SERVER['PATH_INFO'] ?? '/';

session_start();
// session_regenerate_id();
$publicRoutes = ['/', '/login'];
// if not logged and not accessing public routes, redirect to login:
if (!array_key_exists('logged', $_SESSION) && !in_array($pathInfo, $publicRoutes)) {
	header('Location: /login');
	return;
}

$key = "$httpMethod|$pathInfo";
$controller = new Error404Controller();

if (array_key_exists($key, $routes)) {
	$controllerClass = $routes[$key];
	$controller = $diContainer->get($controllerClass);
}

$psr17Factory = new Psr17Factory();
$creator = new ServerRequestCreator(
	$psr17Factory, // ServerRequestFactory
	$psr17Factory, // UriFactory
	$psr17Factory, // UploadedFileFactory
	$psr17Factory, // StreamFactory
);

$request = $creator->fromGlobals();

/** @var RequestHandlerInterface $controller */
$response = $controller->handle($request);

http_response_code($response->getStatusCode());
foreach ($response->getHeaders() as $name => $values) {
	foreach ($values as $value) {
		header(sprintf('%s: %s', $name, $value), false);
	}
}

echo $response->getBody();

/**
 * - try_catch na merda toda para retornar resposta de erro, senão a gambiara é grande
 * - criar header e footer
 *  - header: cardápio virtual - administração
 *  - footer: informações de contato, redes sociais, endereço
 * - criar link para voltar ao topo
 * - utilizar token de acesso para poder acessar admin e form
 * - utilizar display grid no cardápio e nos radioButtons
 */

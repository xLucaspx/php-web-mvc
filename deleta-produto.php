<?php

use Xlucaspx\PhpWebSerenatto\Infra\Connection\ConnectionFactory;
use Xlucaspx\PhpWebSerenatto\Infra\Repository\PdoProdutoRepository;

require_once 'vendor/autoload.php';

if (!$_SERVER['REQUEST_METHOD'] == 'DELETE') {
	http_response_code(405);
}

$id = filter_input(INPUT_GET, 'id');

if (!$id) {
	http_response_code(400);
}

$repository = new PdoProdutoRepository(ConnectionFactory::getConnection());
$repository->exclui($id);
http_response_code(204);

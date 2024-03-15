<?php

namespace Xlucaspx\PhpWebSerenatto\Infra\Controller\Product;

use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Xlucaspx\PhpWebSerenatto\Domain\Repository\ProductRepository;

class DeleteProductController implements RequestHandlerInterface
{
	public function __construct(
		private ProductRepository $productRepository
	) {}

	public function handle(ServerRequestInterface $request): ResponseInterface
	{
		$id = filter_var($request->getQueryParams()['id'], FILTER_VALIDATE_INT);

		if (!$id) {
			return new Response(400, body: json_encode(['error' => 'ID do produto não informado!']));
		}

		$success = $this->productRepository->delete($id);

		if (!$success) {
			return new Response(500, body: json_encode(['error' => 'Ocorreu um erro inesperado ao tentar excluir!']));
		}

		return new Response(204);
	}
}

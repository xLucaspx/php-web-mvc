<?php

namespace Xlucaspx\PhpWebSerenatto\Infra\Controller\Product;

use League\Plates\Engine;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Xlucaspx\PhpWebSerenatto\Domain\Repository\ProductRepository;
use Xlucaspx\PhpWebSerenatto\Domain\Repository\TypeRepository;

class ProductFormController implements RequestHandlerInterface
{
	public function __construct(
		private ProductRepository $productRepository,
		private TypeRepository $typeRepository,
		private Engine $templates
	) {}

	public function handle(ServerRequestInterface $request): ResponseInterface
	{
		$queryParams = $request->getQueryParams();
		$productId = filter_var($queryParams['id'] ?? '', FILTER_VALIDATE_INT);

		$types = $this->typeRepository->all();

		$product = null;
		if ($productId) {
			$product = $this->productRepository->findById($productId);
		}

		return new Response(200, body: $this->templates->render(
			'form-produto',
			[
				'product' => $product,
				'types' => $types
			]
		));
	}
}

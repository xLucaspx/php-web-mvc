<?php

namespace Xlucaspx\PhpWebSerenatto\Infra\Controller;

use League\Plates\Engine;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Xlucaspx\PhpWebSerenatto\Domain\Repository\ProductRepository;
use Xlucaspx\PhpWebSerenatto\Domain\Repository\TypeRepository;

class AdminController implements RequestHandlerInterface
{

	public function __construct(
		private ProductRepository $productRepository,
		private TypeRepository $typeRepository,
		private Engine $templates
	) {}

	public function handle(ServerRequestInterface $request): ResponseInterface
	{
		$types = $this->typeRepository->allReport();
		$products = $this->productRepository->all();
		return new Response(200, body: $this->templates->render(
			'admin',
			[
				'products' => $products,
				'types' => $types,
			]
		));
	}
}

<?php

namespace Xlucaspx\PhpWebSerenatto\Infra\Controller;

use League\Plates\Engine;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Xlucaspx\PhpWebSerenatto\Domain\Model\Type\TypeDetailsDto;
use Xlucaspx\PhpWebSerenatto\Domain\Repository\ProductRepository;
use Xlucaspx\PhpWebSerenatto\Domain\Repository\TypeRepository;

class HomepageController implements RequestHandlerInterface
{
	public function __construct(
		private ProductRepository $productRepository,
		private TypeRepository $typeRepository,
		private Engine $templates
	) {}

	public function handle(ServerRequestInterface $request): ResponseInterface
	{
		/** @var TypeDetailsDto[] $types */
		$types = $this->typeRepository->all();
		$products = [];

		foreach ($types as $type) {
			$typeProducts = $this->productRepository->allByType($type);
			$products[$type->type] = $typeProducts;
		}

		return new Response(200, body: $this->templates->render(
			'homepage',
			['products' => $products]
		));
	}
}

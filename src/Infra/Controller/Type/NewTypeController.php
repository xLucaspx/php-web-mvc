<?php

namespace Xlucaspx\PhpWebSerenatto\Infra\Controller\Type;

use DomainException;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Xlucaspx\PhpWebSerenatto\Domain\Model\Type\NewTypeDto;
use Xlucaspx\PhpWebSerenatto\Domain\Model\Type\UpdateTypeDto;
use Xlucaspx\PhpWebSerenatto\Domain\Repository\TypeRepository;

class NewTypeController implements RequestHandlerInterface
{
	public function __construct(
		private TypeRepository $typeRepository
	) {}

	public function handle(ServerRequestInterface $request): ResponseInterface
	{
		$body = json_decode($request->getBody()->getContents(), true);

		$type = filter_var($body['type']);

		$success = $this->typeRepository->add(new NewTypeDto($type));

		if (!$success) {
			return new Response(500, body: json_encode(['error' => 'Ocorreu um erro inesperado ao tentar cadastrar!']));
		}

		return new Response(201);
	}
}

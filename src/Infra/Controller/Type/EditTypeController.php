<?php

namespace Xlucaspx\PhpWebSerenatto\Infra\Controller\Type;

use DomainException;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Xlucaspx\PhpWebSerenatto\Domain\Model\Type\UpdateTypeDto;
use Xlucaspx\PhpWebSerenatto\Domain\Repository\TypeRepository;

class EditTypeController implements RequestHandlerInterface
{
	public function __construct(
		private TypeRepository $typeRepository
	) {}

	public function handle(ServerRequestInterface $request): ResponseInterface
	{
		$body = json_decode($request->getBody()->getContents(), true);

		$id = filter_var($body['id'], FILTER_VALIDATE_INT);
		$type = filter_var($body['type']);

		if (!$id) {
			return new Response(400, body: json_encode(['error' => 'ID do tipo não informado!']));
		}

		$success = $this->typeRepository->update(new UpdateTypeDto($id, $type));

		if (!$success) {
			return new Response(500, body: json_encode(['error' => 'Ocorreu um erro inesperado ao tentar atualizar!']));
		}

		return new Response(200);
	}
}

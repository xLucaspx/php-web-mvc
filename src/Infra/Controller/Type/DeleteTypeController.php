<?php

namespace Xlucaspx\PhpWebSerenatto\Infra\Controller\Type;

use Nyholm\Psr7\Response;
use PDOException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Xlucaspx\PhpWebSerenatto\Domain\Repository\ProductRepository;
use Xlucaspx\PhpWebSerenatto\Domain\Repository\TypeRepository;

class DeleteTypeController implements RequestHandlerInterface
{
	public function __construct(
		private TypeRepository $typeRepository
	) {}

	public function handle(ServerRequestInterface $request): ResponseInterface
	{
		$id = filter_var($request->getQueryParams()['id'], FILTER_VALIDATE_INT);

		if (!$id) {
			return new Response(400, body: json_encode(['error' => 'ID do tipo não informado!']));
		}

		try {
			$success = $this->typeRepository->delete($id);

			if (!$success) {
				return new Response(500, body: json_encode(['error' => 'Ocorreu um erro inesperado ao tentar excluir!']));
			}

			return new Response(204);
		} catch (PDOException) {
			return new Response(500, body: json_encode(['error' => 'Ocorreu um erro inesperado ao tentar excluir!']));
		}
	}
}

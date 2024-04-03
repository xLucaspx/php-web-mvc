<?php

namespace Xlucaspx\PhpWebSerenatto\Infra\Controller\Login;

use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Xlucaspx\PhpWebSerenatto\Domain\Model\User\RehashUserPasswordDto;
use Xlucaspx\PhpWebSerenatto\Domain\Repository\UserRepository;

class LoginController implements RequestHandlerInterface
{

	public function __construct(
		private UserRepository $userRepository
	) {}

	public function handle(ServerRequestInterface $request): ResponseInterface
	{
		$body = $request->getParsedBody();

		$typedEmail = filter_var($body['email'], FILTER_VALIDATE_EMAIL);
		$typedPassword = filter_var($body['password']);

		$userData = $this->userRepository->findByEmail($typedEmail);

		if (!$userData || !password_verify($typedPassword, $userData->passwordHash)) {
			// TODO: add error message
			return new Response(400, ['Location' => '/login']);
		}

		if (password_needs_rehash($userData->passwordHash, PASSWORD_ARGON2ID)) {
			$updateData = new RehashUserPasswordDto($userData->id, $typedPassword);
			$this->userRepository->updatePassword($updateData);
		}

		$_SESSION['logged'] = true;
		return new Response(302, ['Location' => '/admin']);
	}
}

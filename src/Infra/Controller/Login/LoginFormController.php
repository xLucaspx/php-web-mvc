<?php

namespace Xlucaspx\PhpWebSerenatto\Infra\Controller\Login;

use League\Plates\Engine;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class LoginFormController implements RequestHandlerInterface
{
	public function __construct(
		private Engine $templates
	) {}

	public function handle(ServerRequestInterface $request): ResponseInterface
	{
		if (array_key_exists('logged', $_SESSION) && $_SESSION['logged'] === true) {
			return new Response(302, [
				'Location' => '/'
			]);
		}

		return new Response(200, body: $this->templates->render('form-login'));
	}
}

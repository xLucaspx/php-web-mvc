<?php

namespace Xlucaspx\PhpWebSerenatto\Domain\Model\User;

class UserLoginDto
{
	public function __construct(
		public readonly int $id,
		public readonly string $email,
		public readonly string $passwordHash
	) {}
}

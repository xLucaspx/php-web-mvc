<?php

namespace Xlucaspx\PhpWebSerenatto\Domain\Model\User;

class RehashUserPasswordDto
{
	public readonly string $newHash;

	public function __construct(
		public readonly int $id,
		string $actualHash
	)
	{
		$this->newHash = password_hash($actualHash, PASSWORD_ARGON2ID);
	}
}

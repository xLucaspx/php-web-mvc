<?php

namespace Xlucaspx\PhpWebSerenatto\Domain\Repository;

use Xlucaspx\PhpWebSerenatto\Domain\Model\User\RehashUserPasswordDto;
use Xlucaspx\PhpWebSerenatto\Domain\Model\User\UserLoginDto;

interface UserRepository
{
	public function findByEmail(string $email): UserLoginDto|false;

	public function updatePassword(RehashUserPasswordDto $data): bool;
}

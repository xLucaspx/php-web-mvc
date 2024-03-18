<?php

namespace Xlucaspx\PhpWebSerenatto\Infra\Repository;

use Override;
use PDO;
use Xlucaspx\PhpWebSerenatto\Domain\Model\User\RehashUserPasswordDto;
use Xlucaspx\PhpWebSerenatto\Domain\Model\User\UserLoginDto;
use Xlucaspx\PhpWebSerenatto\Domain\Repository\UserRepository;

class PdoUserRepository implements UserRepository
{
	public function __construct(
		private PDO $connection
	) {}

	#[Override]
	public function findByEmail(string $email): UserLoginDto|false
	{
		$sql = "SELECT `id`, `password_hash` FROM `users` WHERE `email` = :email";
		$statement = $this->connection->prepare($sql);
		$statement->bindValue(':email', $email);

		$statement->execute();
		$userData = $statement->fetch();

		if (!$userData) {
			return false;
		}

		['id' => $id, 'password_hash' => $passwordHash] = $userData;
		return new UserLoginDto($id, $email, $passwordHash);
	}

	#[Override]
	public function updatePassword(RehashUserPasswordDto $data): bool
	{
		$sql = "UPDATE `users` SET `password_hash` = :hash WHERE `id` = :id";
		$statement = $this->connection->prepare($sql);

		return $statement->execute([
			'hash' => $data->newHash,
			'id' => $data->id
		]);
	}
}

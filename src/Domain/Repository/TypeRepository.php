<?php

namespace Xlucaspx\PhpWebSerenatto\Domain\Repository;

use Xlucaspx\PhpWebSerenatto\Domain\Model\Type\NewTypeDto;
use Xlucaspx\PhpWebSerenatto\Domain\Model\Type\TypeDetailsDto;
use Xlucaspx\PhpWebSerenatto\Domain\Model\Type\UpdateTypeDto;

interface TypeRepository
{
	function all(): array;

	function allReport(): array;

	function findById(int $id): TypeDetailsDto|false;

	function add(NewTypeDto $data): bool;

	function update(UpdateTypeDto $data): bool;

	function delete(int $id): bool;
}

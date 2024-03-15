<?php

namespace Xlucaspx\PhpWebSerenatto\Domain\Repository;

use Xlucaspx\PhpWebSerenatto\Domain\Model\Product\NewProductDto;
use Xlucaspx\PhpWebSerenatto\Domain\Model\Product\ProductDetailsDto;
use Xlucaspx\PhpWebSerenatto\Domain\Model\Product\UpdateProductDto;
use Xlucaspx\PhpWebSerenatto\Domain\Model\Type\TypeDetailsDto;

interface ProductRepository
{
	function all(): array;

	function allByType(TypeDetailsDto $type): array;

	function findById(int $id): ProductDetailsDto|false;

	function add(NewProductDto $data): bool;

	function update(UpdateProductDto $data): bool;

	function delete(int $id): bool;
}

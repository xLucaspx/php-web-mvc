<?php

namespace Xlucaspx\PhpWebSerenatto\Domain\Model\Product;

class UpdateProductDto
{
	// TODO: validations
	public function __construct(
		public readonly int $id,
		public readonly int $typeId,
		public readonly string $name,
		public readonly string $description,
		public readonly ?string $imageUrl,
		public readonly float $price
	) {}
}

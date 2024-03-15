<?php

namespace Xlucaspx\PhpWebSerenatto\Domain\Model\Product;

class NewProductDto
{
	// TODO: validations
	public function __construct(
		public readonly int $typeId,
		public readonly string $name,
		public readonly string $description,
		public readonly ?string $imageUrl,
		public readonly float $price
	) {}
}

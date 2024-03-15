<?php

namespace Xlucaspx\PhpWebSerenatto\Domain\Model\Product;

class ProductDetailsDto
{
	public readonly string $imageUrl;

	public function __construct(
		public readonly int $id,
		public readonly string $type,
		public readonly string $name,
		public readonly string $description,
		?string $imageUrl,
		public readonly float $price
	)
	{
		$this->imageUrl = 'img/produtos/' . ($imageUrl ?? 'default-img-produto.png');
	}

	public function formattedPrice(): string
	{
		return sprintf("R$ %.2f", $this->price);
	}
}

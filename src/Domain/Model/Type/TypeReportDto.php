<?php

namespace Xlucaspx\PhpWebSerenatto\Domain\Model\Type;

class TypeReportDto
{
	public function __construct(
		public readonly int $id,
		public readonly string $type,
		public readonly int $totalProducts,
		public readonly float $averagePrice
	) {}

	public function formattedPrice(): string
	{
		return sprintf("R$ %.2f", $this->averagePrice);
	}
}

<?php

namespace Xlucaspx\PhpWebSerenatto\Domain\Model\Type;

class TypeDetailsDto
{
	public function __construct(
		public readonly int $id,
		public readonly string $type,
	) {}
}

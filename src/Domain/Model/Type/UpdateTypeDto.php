<?php

namespace Xlucaspx\PhpWebSerenatto\Domain\Model\Type;

class UpdateTypeDto
{
	// TODO: validations
	public function __construct(
		public readonly int $id,
		public readonly string $type,
	) {}
}

<?php

namespace Xlucaspx\PhpWebSerenatto\Domain\Model\Type;

class NewTypeDto
{
	// TODO: validations
	public function __construct(
		public readonly string $type
	) {}
}

<?php

namespace Xlucaspx\PhpWebSerenatto\Domain\Model;

class DadosCadastroProduto
{
	public function __construct(
		public readonly TipoProduto $tipo,
		public readonly string $nome,
		public readonly string $descricao,
		public readonly string $urlImagem,
		public readonly float $preco
	) {}
}

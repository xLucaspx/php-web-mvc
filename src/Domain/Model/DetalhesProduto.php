<?php

namespace Xlucaspx\PhpWebSerenatto\Domain\Model;

class DetalhesProduto
{
	public readonly string $urlImagem;

	public function __construct(
		public readonly ?int $id,
		public readonly TipoProduto $tipo,
		public readonly string $nome,
		public readonly string $descricao,
		string $urlImagem,
		public readonly float $preco
	)
	{
		$this->urlImagem = 'img/produtos/' . $urlImagem;
	}

	public function precoFormatado(): string
	{
		return sprintf("R$ %.2f", $this->preco);
	}
}

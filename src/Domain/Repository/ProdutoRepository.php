<?php

namespace Xlucaspx\PhpWebSerenatto\Domain\Repository;

use Xlucaspx\PhpWebSerenatto\Domain\Model\DadosAtualizacaoProduto;
use Xlucaspx\PhpWebSerenatto\Domain\Model\DadosCadastroProduto;
use Xlucaspx\PhpWebSerenatto\Domain\Model\TipoProduto;

interface ProdutoRepository
{
	function buscaTodos(): array;

	function buscaTodosPorTipo(TipoProduto $tipo): array;

	function cadastra(DadosCadastroProduto $dados): bool;

	function atualiza(DadosAtualizacaoProduto $dados): bool;

	function exclui(int $id): bool;
}

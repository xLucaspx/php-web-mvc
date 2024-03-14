<?php

namespace Xlucaspx\PhpWebSerenatto\Infra\Repository;

use Xlucaspx\PhpWebSerenatto\Domain\Model\DadosAtualizacaoProduto;
use Xlucaspx\PhpWebSerenatto\Domain\Model\DadosCadastroProduto;
use Xlucaspx\PhpWebSerenatto\Domain\Model\DetalhesProduto;
use Xlucaspx\PhpWebSerenatto\Domain\Model\TipoProduto;
use Xlucaspx\PhpWebSerenatto\Domain\Repository\ProdutoRepository;

class PdoProdutoRepository implements ProdutoRepository
{

	public function __construct(
		private \PDO $connection
	) {}

	/** @return DetalhesProduto[] */
	function buscaTodos(): array
	{
		$sql = 'SELECT `id`, `tipo`, `nome`, `descricao`, `url_imagem`, `preco` FROM `produtos` ORDER BY `tipo`, `preco`';
		$statement = $this->connection->query($sql);

		return $this->hidrataListaProdutos($statement);
	}

	/** @return DetalhesProduto[] */
	function buscaTodosPorTipo(TipoProduto $tipo): array
	{
		$sql = 'SELECT `id`, `tipo`, `nome`, `descricao`, `url_imagem`, `preco` FROM `produtos` WHERE `tipo` = :tipo ORDER BY `preco`';
		$statement = $this->connection->prepare($sql);
		$statement->execute(['tipo' => $tipo->value]);

		return $this->hidrataListaProdutos($statement);
	}

	function buscaPorId(int $id): DetalhesProduto|false
	{
		$sql = 'SELECT `tipo`, `nome`, `descricao`, `url_imagem`, `preco` FROM `produtos` WHERE `id` = :id';
		$statement = $this->connection->prepare($sql);
		$statement->bindValue('id', $id);

		$statement->execute();
		$dados = $statement->fetch();

		if (!$dados) {
			return false;
		}

		['tipo' => $tipo, 'nome' => $nome, 'descricao' => $descricao, 'url_imagem' => $urlImagem, 'preco' => $preco] = $dados;
		return new DetalhesProduto($id, TipoProduto::from($tipo), $nome, $descricao, $urlImagem, $preco);
	}

	function cadastra(DadosCadastroProduto $dados): bool
	{
		$sql = 'INSERT INTO produtos (`tipo`, `nome`,`descricao`, `url_imagem`, `preco`) VALUES (:tipo, :nome, :descricao, :urlImagem, :preco)';
		$statement = $this->connection->prepare($sql);

		return $statement->execute([
			'tipo' => $dados->tipo->value,
			'nome' => $dados->nome,
			'descricao' => $dados->descricao,
			'urlImagem' => $dados->urlImagem,
			'preco' => $dados->preco
		]);
	}

	function atualiza(DadosAtualizacaoProduto $dados): bool
	{
		$sql = 'UPDATE produtos SET `tipo` = :tipo, `nome` = :nome, `descricao` = :descricao, `url_imagem` = :urlImagem, `preco` = :preco WHERE id = :id';
		$statement = $this->connection->prepare($sql);

		return $statement->execute([
			'tipo' => $dados->tipo->value,
			'nome' => $dados->nome,
			'descricao' => $dados->descricao,
			'urlImagem' => $dados->urlImagem,
			'preco' => $dados->preco,
			'id' => $dados->id
		]);
	}

	function exclui(int $id): bool
	{
		$statement = $this->connection->prepare("DELETE FROM produtos WHERE id = :id");
		return $statement->execute(['id' => $id]);
	}

	/** @return DetalhesProduto[] */
	private function hidrataListaProdutos(\PDOStatement $statement): array
	{
		$dados = $statement->fetchAll();

		$lista = array_map(function (array $dadosProduto) {
			['id' => $id, 'tipo' => $tipo, 'descricao' => $descricao, 'nome' => $nome, 'url_imagem' => $urlImagem, 'preco' => $preco] = $dadosProduto;

			return new DetalhesProduto($id, TipoProduto::from($tipo), $nome, $descricao, $urlImagem, $preco);
		}, $dados);

		return $lista;
	}
}

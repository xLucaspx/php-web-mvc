<?php

require_once 'vendor/autoload.php';

use Xlucaspx\PhpWebSerenatto\Domain\Model\DadosAtualizacaoProduto;
use Xlucaspx\PhpWebSerenatto\Domain\Model\DadosCadastroProduto;
use Xlucaspx\PhpWebSerenatto\Domain\Model\TipoProduto;
use Xlucaspx\PhpWebSerenatto\Infra\Connection\ConnectionFactory;
use Xlucaspx\PhpWebSerenatto\Infra\Repository\PdoProdutoRepository;

$connection = ConnectionFactory::getConnection();
$repository = new PdoProdutoRepository($connection);

$id = filter_input(INPUT_POST, 'id');
$tipo = filter_input(INPUT_POST, 'tipo');
$tipo = TipoProduto::from($tipo);
$nome = filter_input(INPUT_POST, 'nome');
$descricao = filter_input(INPUT_POST, 'descricao');
$preco = filter_input(INPUT_POST, 'preco');
$urlImagem = 'default-img-produto.png';

$connection->beginTransaction();

try {
	if ($_FILES['imagem']['error'] === UPLOAD_ERR_OK) {
		$urlImagem = (uniqid() . $_FILES['imagem']['name']);
		move_uploaded_file($_FILES['imagem']['tmp_name'], 'public/img/produtos/' . $urlImagem);
	}

	$id
		? $repository->atualiza(new DadosAtualizacaoProduto($id, $tipo, $nome, $descricao, $urlImagem, $preco))
		: $repository->cadastra(new DadosCadastroProduto($tipo, $nome, $descricao, $urlImagem, $preco));

	$connection->commit();
	header('Location: public/views/admin.php');
} catch (Throwable $e) {
	echo "Erro ao tentar realizar a operação: {$e->getMessage()} em {$e->getFile()}:{$e->getLine()}";
	echo $e->getTraceAsString();
	$connection->rollBack();
}

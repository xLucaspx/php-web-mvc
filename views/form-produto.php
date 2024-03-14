<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Xlucaspx\PhpWebSerenatto\Infra\Connection\ConnectionFactory;
use Xlucaspx\PhpWebSerenatto\Infra\Repository\PdoProdutoRepository;

$id = filter_input(INPUT_GET, 'id');
$produto = null;

if ($id) {
	$repository = new PdoProdutoRepository(ConnectionFactory::getConnection());
	$produto = $repository->buscaPorId($id);
}

$title = $produto ? 'Editar produto' : 'Cadastrar produto';
$tipo = $produto ? $produto->tipo->value : null;
?>

<!doctype html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
		content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">

	<title><?= $title ?></title>

	<link rel="icon" href="../public/img/icone-serenatto.png" type="image/x-icon">

	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link rel="stylesheet"
		href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;900&display=swap">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;500;600;700&display=swap">

	<link rel="stylesheet" href="../public/css/reset.css">
	<link rel="stylesheet" href="../public/css/index.css">
	<link rel="stylesheet" href="../public/css/admin.css">
	<link rel="stylesheet" href="../public/css/form.css">
</head>
<body>
<header class="container-admin-banner">
	<img src="../public/img/logo-serenatto-horizontal.png" class="logo-admin" alt="Logo da Serenatto">
	<h1><?= $title ?></h1>
	<img class="ornaments" src="../public/img/ornaments-coffee.png" alt>
</header>

<main>
	<section class="container-form">
		<form method="post" enctype="multipart/form-data" action="../handle-submit-produto.php">

			<label for="nome">Nome</label>
			<input type="text" id="nome" name="nome" placeholder="Digite o nome do produto"
				value="<?= $produto ? $produto->nome : '' ?>"
				required>

			<div class="container-radio">
				<div>
					<label for="cafe">Café</label>
					<input type="radio" id="cafe" name="tipo" value="Café" <?= $tipo === "Café" ? "checked" : '' ?>>
				</div>
				<div>
					<label for="almoco">Almoço</label>
					<input type="radio" id="almoco" name="tipo" value="Almoço" <?= $tipo === "Almoço" ? "checked" : '' ?>>
				</div>
			</div>

			<label for="descricao">Descrição</label>
			<input type="text" name="descricao" id="descricao" value="<?= $produto ? $produto->descricao : '' ?>"
				placeholder="Digite uma descrição" required>

			<label for="preco">Preço</label>
			<input type="number" name="preco" id="preco" step=".01" value="<?= $produto ? $produto->preco : 0 ?>"
				placeholder="Digite o preço do produto" required>

			<label for="imagem">Envie uma imagem do produto</label>
			<input type="file" name="imagem" accept="image/*" id="imagem" placeholder="Envie uma imagem">

			<?= $produto ? "<input value='$produto->id' type='hidden' name='id'>" : '' ?>

			<button type="submit" class="<?= $produto ? 'botao-editar' : 'botao-cadastrar' ?>"><?= $title ?></button>
		</form>
	</section>
</main>
</body>
</html>

<?php

use Xlucaspx\PhpWebSerenatto\Infra\Connection\ConnectionFactory;
use Xlucaspx\PhpWebSerenatto\Infra\Repository\PdoProdutoRepository;

require_once __DIR__ . '/../vendor/autoload.php';

$repository = new PdoProdutoRepository(ConnectionFactory::getConnection());

$produtos = $repository->buscaTodos();
?>

<!doctype html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
		content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">

	<title>Serenatto - Admin</title>

	<link rel="icon" href="../public/img/icone-serenatto.png" type="image/x-icon">

	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link rel="stylesheet"
		href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;900&display=swap">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;500;600;700&display=swap">

	<link rel="stylesheet" href="../public/css/reset.css">
	<link rel="stylesheet" href="../public/css/style.css">
	<link rel="stylesheet" href="../public/css/admin.css">
</head>

<body>
<header class="header">
	<img src="../public/img/logo-serenatto-horizontal.png" class="header__logo" alt="Logo da Serenatto">

	<nav class="header__nav">
		<ul class="header__nav__ul">
			<li class="header__nav__ul__li"><a href="/" class="link">Home</a></li>
			<li class="header__nav__ul__li"><a href="/admin" class="link">Administração</a></li>
		</ul>
	</nav>
</header>

<main class="container">
	<section class="container__banner">
		<h1 class="title">Admistração Serenatto</h1>
		<img class="ornaments" src="../public/img/ornaments-coffee.png" alt>
	</section>

	<h2 class="subtitle">Lista de Produtos</h2>

	<section class="container__table">
		<table class="table">
			<thead>
			<tr class="table__tr">
				<th class="table__th">Produto</th>
				<th class="table__th">Tipo</th>
				<th class="table__th">Descricão</th>
				<th class="table__th">Valor</th>
				<th colspan="2" class="table__th table__col--acao">Ação</th>
			</tr>
			</thead>
			<tbody>
			<?php foreach ($produtos as $produto): ?>
				<tr class="table__tr">
					<td class="table__td"><?= $produto->nome ?></td>
					<td class="table__td"><?= $produto->tipo->value ?></td>
					<td class="table__td"><?= $produto->descricao ?></td>
					<td class="table__td"><?= $produto->precoFormatado() ?></td>
					<td class="table__td table__col--acao"><a class="button button--secondary table__button" href="form-produto.php?id=<?= $produto->id ?>">Editar</a>
					</td>
					<td class="table__td table__col--acao">
						<button type="button" class="button button--danger table__button" data-id="<?= $produto->id ?>" data-nome="<?= $produto->nome ?>">
							Excluir
						</button>
					</td>
				</tr>
			<?php endforeach; ?>
			</tbody>
		</table>

		<a class="button button--primary" href="form-produto.php">Cadastrar produto</a>

		<!--		<form action="gerador-pdf.php" method="post">-->
		<!--			<input type="submit" class="botao-cadastrar" value="Baixar Relatório"/>-->
		<!--		</form>-->
	</section>
</main>
</body>
<script src="../public/js/deleta-produto.js" type="module"></script>
</html>

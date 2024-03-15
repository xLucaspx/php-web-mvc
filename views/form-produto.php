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

	<title>
		<?= $title ?>
	</title>

	<link rel="icon" href="../public/img/icone-serenatto.png" type="image/x-icon">

	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link rel="stylesheet"
		href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;900&display=swap">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;500;600;700&display=swap">

	<link rel="stylesheet" href="../public/css/reset.css">
	<link rel="stylesheet" href="../public/css/style.css">
	<link rel="stylesheet" href="../public/css/form.css">
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

	<main>
		<section class="container">
			<form method="post" enctype="multipart/form-data" action="../handle-submit-produto.php" class="form">

				<fieldset class="form__fieldset">
					<legend class="subtitle"><?= $title ?></legend>

					<label for="nome" class="form__label">Nome</label>
					<input type="text" id="nome" name="nome" class="form__input" placeholder="Digite o nome do produto"
						value="<?= $produto ? $produto->nome : '' ?>" required>

					<fieldset class="form__fieldset--radio">
						<legend class="form__legend">Tipo</legend>

						<div class="form__container--radio">
							<div>
								<label for="cafe" class="form__label">Café</label>
								<input type="radio" id="cafe" name="tipo" class="form__input" value="Café" <?= $tipo === "Café" ? "checked" : '' ?> required>
							</div>

							<div>
								<label for="almoco" class="form__label">Almoço</label>
								<input type="radio" id="almoco" name="tipo" class="form__input" value="Almoço" <?= $tipo === "Almoço" ? "checked" : '' ?>>
							</div>
						</div>
					</fieldset>

					<label for="descricao" class="form__label">Descrição</label>
					<input type="text" name="descricao" id="descricao" class="form__input"
						value="<?= $produto ? $produto->descricao : '' ?>" placeholder="Digite uma descrição" required>

					<label for="preco" class="form__label">Preço</label>
					<input type="number" name="preco" id="preco" class="form__input" step=".01"
						value="<?= $produto ? $produto->preco : 0 ?>" placeholder="Digite o preço do produto" required>

					<label for="imagem" class="form__label">Envie uma imagem do produto</label>
					<input type="file" name="imagem" accept="image/*" class="form__input form__input--file" id="imagem"
						placeholder="Envie uma imagem">

					<?= $produto ? "<input value='$produto->id' type='hidden' name='id'>" : '' ?>
				</fieldset>

				<button type="submit" class="button button--primary">
					<?= $title ?>
				</button>
			</form>
		</section>
	</main>
</body>

</html>
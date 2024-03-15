<?php
/** @var \Xlucaspx\PhpWebSerenatto\Domain\Model\Type\TypeDetailsDto[] $types */
/** @var \Xlucaspx\PhpWebSerenatto\Domain\Model\Product\ProductDetailsDto $product */

$title = $product ? 'Editar produto' : 'Cadastrar produto';
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

	<link rel="icon" href="img/icone-serenatto.png" type="image/x-icon">

	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link rel="stylesheet"
		href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;900&display=swap">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;500;600;700&display=swap">

	<link rel="stylesheet" href="css/reset.css">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/form.css">
</head>

<body>
<header class="header">
	<img src="img/logo-serenatto-horizontal.png" class="header__logo" alt="Logo da Serenatto">

	<nav class="header__nav">
		<ul class="header__nav__ul">
			<li class="header__nav__ul__li"><a href="/" class="link">Home</a></li>
			<li class="header__nav__ul__li"><a href="/admin" class="link">Administração</a></li>
		</ul>
	</nav>
</header>

<main>
	<section class="container">
		<form method="post" enctype="multipart/form-data" class="form">

			<fieldset class="form__fieldset">
				<legend class="subtitle"><?= $title ?></legend>

				<label for="name" class="form__label">Nome</label>
				<input type="text" id="name" name="name" class="form__input" placeholder="Digite o nome do produto"
					value="<?= $product?->name ?>" required>

				<fieldset class="form__fieldset--radio">
					<legend class="form__legend">Tipo</legend>

					<div class="form__container--radio">
						<?php foreach ($types as $type) : ?>
							<label class="form__label">
								<input type="radio" name="type" class="form__input"
									value="<?= $type->id ?>" <?= $product?->type === $type->type ? "checked" : '' ?> required>
								<?= $type->type ?>
							</label>
						<?php endforeach; ?>
				</fieldset>

				<label for="description" class="form__label">Descrição</label>
				<input type="text" name="description" id="description" class="form__input"
					value="<?= $product?->description ?>" placeholder="Digite uma descrição" required>

				<label for="price" class="form__label">Preço</label>
				<input type="number" name="price" id="price" class="form__input" step=".01"
					value="<?= $product?->price ?>" placeholder="Digite o preço do produto" required>

				<label for="image" class="form__label">Envie uma imagem do produto</label>
				<input type="file" name="image" accept="image/*" class="form__input form__input--file" id="image"
					placeholder="Envie uma imagem">
			</fieldset>

			<button type="submit" class="button button--primary"><?= $title ?></button>
		</form>
	</section>
</main>
</body>
</html>

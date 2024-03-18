<?php
/** @var array $products */
/** @var \Xlucaspx\PhpWebSerenatto\Domain\Model\Product\ProductDetailsDto[] $productList */
$this->layout('layout');
?>
<!doctype html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
		content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">

	<title>Serenatto Café e Bistrô</title>

	<link rel="icon" href="img/icone-serenatto.png" type="image/x-icon">

	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link rel="stylesheet"
		href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;900&display=swap">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;500;600;700&display=swap">

	<link rel="stylesheet" href="css/reset.css">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/home.css">

	<title>Serenatto - Cardápio</title>
</head>

<body>
<?= $this->insert('header'); ?>

<main>
	<section class="container__banner">
		<h1 class="title">Cardápio Digital</h1>
	</section>


	<?php foreach ($products as $type => $productList): ?>
		<section class="container container__cardapio">
			<div class="container__cardapio__header">
				<h3 class="subtitle"><?= "Opções de $type" ?></h3>
				<img class="ornaments" src="img/ornaments-coffee.png" alt>
			</div>

			<ul class="lista__cardapio__produtos">
				<?php foreach ($productList as $product): ?>
					<li class="lista__produtos__produto">
						<div>
							<img src="<?= $product->imageUrl ?>" alt class="cardapio__produtos__produto__img">
						</div>
						<p
							class="cardapio__produtos__produto__texto cardapio__produtos__produto__texto--nome"><?= $product->name ?></p>
						<p class="cardapio__produtos__produto__texto"><?= $product->description ?></p>
						<p
							class="cardapio__produtos__produto__texto cardapio__produtos__produto__texto--preco"><?= $product->formattedPrice() ?></p>
					</li>
				<?php endforeach; ?>
			</ul>
		</section>
	<?php endforeach; ?>
</main>
</body>
<!-- HTML closed in layout -->


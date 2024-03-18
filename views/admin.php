<?php
/** @var \Xlucaspx\PhpWebSerenatto\Domain\Model\Type\TypeReportDto[] $types */
/** @var \Xlucaspx\PhpWebSerenatto\Domain\Model\Product\ProductDetailsDto[] $products */
$this->layout('layout');
?>

<!doctype html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
		content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">

	<title>Serenatto - Admin</title>

	<link rel="icon" href="img/icone-serenatto.png" type="image/x-icon">

	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link rel="stylesheet"
		href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;900&display=swap">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;500;600;700&display=swap">

	<link rel="stylesheet" href="css/reset.css">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/admin.css">
</head>

<body>
<?= $this->insert('header'); ?>

<main class="container">
	<section class="container__banner">
		<h1 class="title">Admistração Serenatto</h1>
		<img class="ornaments" src="img/ornaments-coffee.png" alt>
	</section>

	<!-- Products -->
	<section class="container__table">
		<h2 class="subtitle">Lista de Produtos</h2>

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
			<?php foreach ($products as $product): ?>
				<tr class="table__tr">
					<td class="table__td"><?= $product->name ?></td>
					<td class="table__td"><?= $product->type ?></td>
					<td class="table__td"><?= $product->description ?></td>
					<td class="table__td"><?= $product->formattedPrice() ?></td>
					<td class="table__td table__col--acao"><a class="button button--secondary button--small"
							href="/editar-produto?id=<?= $product->id ?>">Editar</a>
					</td>
					<td class="table__td table__col--acao">
						<button type="button" class="button button--danger button--small delete-product-button"
							data-id="<?= $product->id ?>" data-name="<?= $product->name ?>">
							Excluir
						</button>
					</td>
				</tr>
			<?php endforeach; ?>
			</tbody>
		</table>

		<a class="button button--primary" href="/novo-produto">Cadastrar produto</a>
	</section>

	<!-- Types -->
	<section class="container__table">
		<h2 class="subtitle">Lista de Tipos</h2>

		<table class="table">
			<thead>
			<tr class="table__tr">
				<th class="table__th">Tipo</th>
				<th class="table__th">Total de produtos</th>
				<th class="table__th">Preço médio</th>
				<th colspan="2" class="table__th table__col--acao">Ação</th>
			</tr>
			</thead>
			<tbody>
			<?php foreach ($types as $type): ?>
				<tr class="table__tr">
					<td class="table__td"><?= $type->type ?></td>
					<td class="table__td"><?= $type->totalProducts ?></td>
					<td class="table__td"><?= $type->formattedPrice() ?></td>
					<td class="table__td table__col--acao">
						<button type="button" class="button button--secondary button--small edit-type-button"
							data-id="<?= $type->id ?>" data-type="<?= $type->type ?>">Editar</button>
					</td>
					<td class="table__td table__col--acao">
						<button type="button" class="button button--danger button--small delete-type-button"
							data-id="<?= $type->id ?>" data-type="<?= $type->type ?>">
							Excluir
						</button>
					</td>
				</tr>
			<?php endforeach; ?>
			</tbody>
		</table>

		<button type="button" class="button button--primary new-type-button">Cadastrar tipo</button>
	</section>

	<!--		<form action="gerador-pdf.php" method="post">-->
	<!--			<input type="submit" class="botao-cadastrar" value="Baixar Relatório"/>-->
	<!--		</form>-->
</main>
</body>
<script src="js/delete-product.js" type="module"></script>
<script src="js/create-type.js" type="module"></script>
<script src="js/edit-type.js" type="module"></script>
<script src="js/delete-type.js" type="module"></script>
<!-- HTML closed in layout -->

<?php

use Xlucaspx\PhpWebSerenatto\Domain\Model\TipoProduto;
use Xlucaspx\PhpWebSerenatto\Infra\Connection\ConnectionFactory;
use Xlucaspx\PhpWebSerenatto\Infra\Repository\PdoProdutoRepository;

require_once __DIR__ . '/../vendor/autoload.php';

/**
 * - tipo como tabela, relação `produtos n <-> 1 tipos`;
 * - criar formulário de cadastro/alteração de tipo;
 * - criar listagem de tipos em admin (?)
 * - order by tipo: alfabético ou id;
 * - criar header e footer
 *  - header: cardápio virtual - administração
 *  - footer: informações de contato, redes sociais, endereço
 * - melhorar organização e classes da estilização
 * - criar link para voltar ao topo
 * - criar página de login para acessar admin
 * - utilizar token de acesso para poder acessar admin e form
 * - utilizar display grid no cardápio
 */

$repository = new PdoProdutoRepository(ConnectionFactory::getConnection());

$produtosCafe = $repository->buscaTodosPorTipo(TipoProduto::Cafe);
$produtosAlmoco = $repository->buscaTodosPorTipo(TipoProduto::Almoco);

$produtos = [
	'Café' => $produtosCafe,
	'Almoço' => $produtosAlmoco
];
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

	<link rel="stylesheet" href="./css/reset.css">
	<link rel="stylesheet" href="./css/style.css">
	<link rel="stylesheet" href="./css/home.css">

	<title>Serenatto - Cardápio</title>
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
	<section class="container__banner">
		<h1 class="title">Cardápio Digital</h1>
	</section>


	<?php foreach ($produtos as $tipo => $arrProdutos): ?>
		<section class="container container__cardapio">
			<div class="container__cardapio__header">
				<h3 class="subtitle"><?= "Opções para o $tipo" ?></h3>
				<img class="ornaments" src="img/ornaments-coffee.png" alt>
			</div>

			<div class="container__cardapio__produtos">
				<?php foreach ($arrProdutos as $produto): ?>
					<div class="cardapio__produtos__produto">
						<div>
							<img src="<?= $produto->urlImagem ?>" alt class="cardapio__produtos__produto__img">
						</div>
						<p
							class="cardapio__produtos__produto__texto cardapio__produtos__produto__texto--nome"><?= $produto->nome ?></p>
						<p class="cardapio__produtos__produto__texto"><?= $produto->descricao ?></p>
						<p
							class="cardapio__produtos__produto__texto cardapio__produtos__produto__texto--preco"><?= $produto->precoFormatado() ?></p>
					</div>
				<?php endforeach; ?>
			</div>
		</section>
	<?php endforeach; ?>
</main>
</body>
</html>

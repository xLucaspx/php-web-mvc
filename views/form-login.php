<?php
$this->layout('components/layout');
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
	<link rel="stylesheet" href="css/form.css">
</head>

<body>
<?= $this->insert('components/header'); ?>

<main>
	<section class="container__banner">
		<h1 class="title">Login Serenatto</h1>
		<img class="ornaments" src="img/ornaments-coffee.png" alt>
	</section>

	<section class="container">
		<form method="post" class="form">

			<fieldset class="form__fieldset">
				<label for="email" class="form__label">E-mail</label>
				<input type="email" id="email" name="email" class="form__input" placeholder="Digite o seu e-mail" required>

				<label for="password" class="form__label">Senha</label>
				<input type="password" id="password" name="password" class="form__input" placeholder="Digite a sua senha"
					required>
			</fieldset>

			<button type="submit" class="button button--primary">Login</button>
		</form>
	</section>
</main>

<?= $this->insert('components/footer'); ?>
</body>
<!-- HTML closed in layout -->

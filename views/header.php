<?php
$logged = array_key_exists('logged', $_SESSION) && $_SESSION['logged'] === true;
?>

<header class="header">
	<img src="img/logo-serenatto-horizontal.png" class="header__logo" alt="Logo da Serenatto">

	<div class="header__div">
		<nav class="header__nav">
			<ul class="header__nav__ul">
				<li class="header__nav__ul__li"><a href="/" class="link">Home</a></li>
				<li class="header__nav__ul__li"><a href="/admin" class="link">Administração</a></li>
			</ul>
		</nav>

		<?= $logged ? '<a class="button button--danger button--small" href="/logout">Logout</a>' : '' ?>
	</div>
</header>

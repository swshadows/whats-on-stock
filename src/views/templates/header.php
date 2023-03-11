<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="css/main.css">
	<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
	<title><?= __NAME__ ?></title>
</head>

<body>

	<header class="header">
		<div class="__wrapper">
			<img width="50" src="favicon.ico" alt="Ícone da aplicação"> <span><?= __NAME__ ?></span>
		</div>
		<?php if (isset($_SESSION['LOGIN_INFO'])) : ?>
			<a class="--link" href="/user/logout">Sair</a>
		<?php endif; ?>
	</header>
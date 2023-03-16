<?php
require_once __SRC__ . "/controllers/App.controller.php";

$is_logged = App::check_auth();

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
		<div class="links wrapper">
			<a href="/"><img width="50" src="favicon.ico" alt="Ícone da aplicação"></a>
			<a href="/"><span><?= __NAME__ ?></span></a>
		</div>
		<?php if ($is_logged) : ?>
			<div class="wrapper">
				<?php if (App::get_req_uri() != '/app') : ?>
					<a href="/app" class="link-button">Voltar à aplicação</a>
				<?php else : ?>
					<a href="/me" class="link-button">Minhas informações</a>
				<?php endif; ?>
				<a href="/user/logout" class="link-button">Sair</a>
			</div>
		<?php endif; ?>
	</header>
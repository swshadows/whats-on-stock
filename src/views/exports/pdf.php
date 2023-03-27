<?php
require_once __SRC__ . "/controllers/App.controller.php";
require_once __SRC__ . "/utils/Message.php";

if (!App::check_auth()) {
	App::set_message(new Message(MessagePatterns::NotLogged), "/");
}

require_once __SRC__ . "/models/ItemDAO.php";
$item_dao = new ItemDAO();
$arr = [
	"user" => $_SESSION['LOGIN']['email'],
	"data" => []
];

$arr['data'] = $item_dao->find_all();

foreach ($arr['data'] as $key => &$item) {
	unset($item['user_id']);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
	<title><?= __NAME__ ?></title>
	<style type="text/css">
		* {
			margin: 0;
			padding: 0;
			font-family: Arial, Helvetica, sans-serif;
		}

		body {
			display: flex;
			flex-direction: column;
			align-items: center;
		}

		.main {
			margin-top: 20px;
			width: 500px;
			display: flex;
			flex-direction: column;
		}

		.user {
			text-align: center;
			margin-bottom: 10px;
		}

		table {
			border-spacing: 0;
		}

		th,
		td {
			text-align: center;
			border: 1px solid black;
		}
	</style>
</head>

<body>
	<div class="main">
		<h2 class="user"> Usuário: <?= $arr['user'] ?></h2>
		<table>
			<thead>
				<tr>
					<th>Nome do item</th>
					<th>Quantidade do item</th>
				</tr>
			</thead>
			<?php foreach ($arr['data'] as $i) : ?>
				<tr>
					<td><?= $i['name'] ?></td>
					<td><?= $i['qty'] ?></td>
				</tr>
			<?php endforeach; ?>
	</div>
	</table>
</body>
<script>
	window.addEventListener("load", () => {
		setTimeout(() => {
			const c = confirm("🖨 Deseja imprimir/exportar os seus dados?")
			if (c) window.print()
		}, 1000);
	})
</script>

</html>
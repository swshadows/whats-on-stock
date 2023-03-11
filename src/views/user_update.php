<?php
require_once "templates/header.php";
require_once __SRC__ . "/models/UserDAO.php";

if (isset($_SESSION['LOGIN'])) {
	$user_dao = new UserDAO();
	$user = $user_dao->find_by_email($_SESSION['LOGIN']);
}
?>

<main class="app">
	<h2 class="update-title">Minhas informações</h2>
	<div class="update-forms">
		<form class="update-me-form">
			<label>E-mail: <?= $user['email'] ?> </label>
			<input required type="email" placeholder="Digite novo email">
			<input type="submit" value="Atualizar email">
		</form>
		<form class="update-me-form">
			<label>Senha:</label>
			<input required type="password" placeholder="Digite sua senha atual">
			<input required type="password" placeholder="Digite nova senha">
			<input required type="password" placeholder="Repita a nova senha">
			<input type="submit" value="Atualizar senha">
		</form>
	</div>
</main>


<?php
require_once "templates/footer.php";
?>
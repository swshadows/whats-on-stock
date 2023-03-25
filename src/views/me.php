<?php
require_once "templates/header.php";
require_once __SRC__ . "/models/UserDAO.php";
require_once 'components/message.php';
require_once __SRC__ . "/controllers/App.controller.php";

$is_logged = App::check_auth();

if ($is_logged) {
	$user_dao = new UserDAO();
	$user = $user_dao->find_by_email($_SESSION['LOGIN']['email']);
} else {
	require_once __SRC__ . "/utils/Message.php";
	App::set_message(new Message(MessagePatterns::NotLogged), "/");
}
?>

<main class="app">
	<h2 class="update-title">Minhas informações</h2>
	<div class="update-forms">
		<form action="/user/update_email" method="POST" class="update-me-form">
			<label>E-mail: <?= $user['email'] ?> </label>
			<input required name="email" type="email" placeholder="Digite novo email">
			<input type="submit" value="Atualizar email">
		</form>
		<form action="/user/update_password" method="POST" class="update-me-form">
			<label>Senha:</label>
			<input required id="password" name="password" type="password" placeholder="Digite sua senha atual">
			<input required id="password-new" name="password-new" type="password" placeholder="Digite nova senha">
			<input required id="password-new-repeat" name="password-new-repeat" type="password" placeholder="Repita a nova senha">
			<label>
				<input type="checkbox" onclick="switchPasswordInputs('password', 'password-new', 'password-new-repeat')"> Mostrar senhas
			</label>
			<input type="submit" value="Atualizar senha">
		</form>
		<button onclick="toggleModal('delete-user-modal')" type="submit" class="open-del-modal">Deletar conta</button>
		<div class="modal hidden" id="delete-user-modal">
			<div class="modal-block">
				<button class="close-modal" onclick="toggleModal('delete-user-modal')">❌</button>
				<p>Deseja realmente apagar o sua conta?</p>
				<p>Essa ação é irreversivel!</p>
				<form action="/user/delete" method="POST">
					<input type="hidden" name="placeholder" value="1">
					<input type="submit" class="account-delete" value="Deletar conta">
				</form>
			</div>
		</div>
	</div>
</main>


<?php
require_once "templates/footer.php";
?>
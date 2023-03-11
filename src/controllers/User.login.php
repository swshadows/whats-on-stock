<?php
session_start();
require_once "App.controller.php";
require_once __SRC__ . "/models/UserDAO.php";

$email = $_POST['email'];
$pswd = $_POST['password'];

$user = new User($email, $pswd);
$user_dao = new UserDAO();

// Valida o formato do email
if (!$user->validate_email()) {
	App::set_message("error", "❌ O email enviado é inválido", "/");
}

// Confere se o email está registrado
$user_saved = $user_dao->find_by_email($user->get_email());
if (!$user_saved) {
	App::set_message("error", "❌ E-mail não registrado", "/");
}

// Vê se a senha tem mais que 8 caracteres e menos que 255 caracteres
if (!$user->check_password_safe()) {
	App::set_message("error", "❌ A senha deve conter de 8 a 255 caracteres", "/");
}

// Confere se a senha digitada e a salva são iguais
if (!$user->dehash_password($user_saved['password'])) {
	App::set_message("error", "❌ Senha incorreta, tente novamente", "/");
}

$_SESSION['LOGIN_INFO'] = $user->get_email();
App::set_message("success", "✅ Login realizado com sucesso", "/app");

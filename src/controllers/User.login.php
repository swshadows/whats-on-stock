<?php
session_start();
require_once "App.controller.php";
require_once __SRC__ . "/models/UserDAO.php";
require __SRC__ . '/utils/messages.php';

$message = new Message();

$email = $_POST['email'];
$pswd = $_POST['password'];

$user = new User($email, $pswd);
$user_dao = new UserDAO();

// Valida o formato do email
if (!$user->validate_email()) {
	$message->email_invalid();
	App::set_message($message->get_type(), $message->get_message(), "/");
}

// Confere se o email está registrado
$user_saved = $user_dao->find_by_email($user->get_email());
if (!$user_saved) {
	$message->email_dont_exist();
	App::set_message($message->get_type(), $message->get_message(), "/");
}

// Vê se a senha tem mais que 8 caracteres e menos que 255 caracteres
if (!$user->check_password_safe()) {
	$message->password_pattern_wrong();
	App::set_message($message->get_type(), $message->get_message(), "/");
}

// Confere se a senha digitada e a salva são iguais
if (!$user->dehash_password($user_saved['password'])) {
	$message->passwords_dont_match();
	App::set_message($message->get_type(), $message->get_message(), "/");
}

$_SESSION['LOGIN'] = $user->get_email();

$message->login_success();
App::set_message($message->get_type(), $message->get_message(), "/");

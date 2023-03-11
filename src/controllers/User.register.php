<?php
require 'App.controller.php';
require __SRC__ . '/models/UserDAO.php';
require __SRC__ . '/utils/messages.php';

$message = new Message();

$email = $_POST['email'];
$pswd = $_POST['password'];
$pswd_repeat = $_POST['password-repeat'];

$user = new User($email, $pswd);

// Compara se as senhas enviadas são iguais
if (!$user->compare_passwords($pswd_repeat)) {
	$message->diff_passwords();
	App::set_message($message->get_type(), $message->get_message(), "/");
}

// Vê se a senha tem mais que 8 caracteres e menos que 255 caracteres
if (!$user->check_password_safe()) {
	$message->password_pattern_wrong();
	App::set_message($message->get_type(), $message->get_message(), "/");
}

// Valida o formato do email
if (!$user->validate_email()) {
	$message->email_invalid();
	App::set_message($message->get_type(), $message->get_message(), "/");
}

$user_dao = new UserDAO();

// Checa se o usuário já está registrado
if ($user_dao->find_by_email($user->get_email())) {
	$message->email_already_exists();
	App::set_message($message->get_type(), $message->get_message(), "/");
}

// Aplica hash na senha
$user->set_password_hash();

// Cria usuário no banco de dados
$user_dao->create($user);

$message->register_success();
App::set_message($message->get_type(), $message->get_message(), "/");

<?php

require 'App.controller.php';
require __SRC__ . '/models/UserDAO.php';
require __SRC__ . '/utils/messages.php';

$message = new Message();

$email = $_POST['email'];

// Checa se o usuário está realmente logado
if (!App::check_auth()) {
	$message->not_auth();
	App::set_message($message, "/");
}

$user = new User($email, "");

// Valida o formato do email
if (!$user->validate_email()) {
	$message->email_invalid();
	App::set_message($message, "/me");
}

$user_dao = new UserDAO();

// Checa se o email já está em uso
if ($user_dao->find_by_email($user->get_email())) {
	$message->email_already_exists();
	App::set_message($message, "/me");
}

$user_dao->update_email($_SESSION['LOGIN']['email'], $user->get_email());
$_SESSION['LOGIN']['email'] = $user->get_email();

$message->email_update_success();
App::set_message($message, "/me");

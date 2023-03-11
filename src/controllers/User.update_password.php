<?php
require 'App.controller.php';
require __SRC__ . '/models/UserDAO.php';
require __SRC__ . '/utils/messages.php';

$message = new Message();

$pswd = $_POST['password'];
$pwsd_new = $_POST['password-new'];
$pswd_repeat = $_POST['password-new-repeat'];

// Checa se o usuário está realmente logado
if (!App::check_auth()) {
	$message->not_auth();
	App::set_message($message, "/");
}

$user = new User($_SESSION['LOGIN'], $pswd);
$user_new  = new User($_SESSION['LOGIN'], $pwsd_new);

// Compara se as senhas enviadas são iguais
if (!$user_new->compare_passwords($pswd_repeat)) {
	$message->diff_passwords();
	App::set_message($message, "/me");
}

// Vê se a senha tem mais que 8 caracteres e menos que 255 caracteres
if (!$user_new->check_password_safe()) {
	$message->password_pattern_wrong();
	App::set_message($message, "/me");
}

$user_dao = new UserDAO();
$user_saved = $user_dao->find_by_email($user->get_email());

// Confere se a senha digitada e a salva são iguais
if (!$user->dehash_password($user_saved['password'])) {
	$message->passwords_dont_match();
	App::set_message($message, "/me");
}

// Aplica hash na senha
$user_new->set_password_hash();
$user_dao->update_password($user->get_email(), $user_new->get_password());

$message->password_update_success();
App::set_message($message, "/me");

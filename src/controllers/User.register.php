<?php
require 'App.controller.php';
require __SRC__ . '/models/UserDAO.php';

$email = $_POST['email'];
$pswd = $_POST['password'];
$pswd_repeat = $_POST['password-repeat'];

$user = new User($email, $pswd);

// Compara se as senhas enviadas são iguais
if (!$user->compare_passwords($pswd_repeat)) {
	App::set_message("error", "❌ Senhas não são iguais, tente novamente");
	App::redirect('/');
}

// Vê se a senha tem mais que 8 caracteres e menos que 255 caracteres
if (!$user->check_password_safe()) {
	App::set_message("error", "❌ A senha deve conter de 8 a 255 caracteres");
	App::redirect('/');
}

// Valida o formato do email
if (!$user->validate_email()) {
	App::set_message("error", "❌ O email enviado é inválido");
	App::redirect('/');
}

// Aplica hash na senha
$user->set_password_hash();

$user_dao = new UserDAO();

// Checa se o usuário já está registrado
if ($user_dao->find_by_email($user->get_email())) {
	App::set_message("error", "❌ Esse e-mail já está registrado");
	App::redirect('/');
}

// Cria usuário no banco de dados
$user_dao->create($user);

App::set_message("success", "✅ Usuário criado com sucesso! Faça login");
App::redirect('/');

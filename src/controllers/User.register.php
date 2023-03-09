<?php
require 'App.controller.php';
require __SRC__ . '/models/UserDAO.php';

$email = $_POST['email'];
$pswd = $_POST['password'];
$pswd_repeat = $_POST['password-repeat'];

$equal_passwords = App::compare_passwords($pswd, $pswd_repeat);

if (!$equal_passwords) {
	App::set_message("error", "❌ Senhas não são iguais, tente novamente");
	App::redirect('/');
}

$user = new User($email, $pswd);
$user_dao = new UserDAO();
$user_dao->create($user);

App::set_message("success", "✅ Usuário criado com sucesso! Faça login");
App::redirect('/');

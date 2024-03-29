<?php
require_once __SRC__ . "/controllers/User.controller.php";
App::forbid_access("/me");


// Checa se o usuário está realmente logado
if (!App::check_auth()) {
	App::set_message(new Message(MessagePatterns::NotLogged), "/");
}

$user = new User($_SESSION['LOGIN']['email'], $_POST['password']);
$user_new = new User($_SESSION['LOGIN']['email'], $_POST['password-new']);

$controller = new UserController($user);
$controller->updatePassword($user_new, $_POST['password-new-repeat']);

<?php
require_once __SRC__ . "/controllers/User.controller.php";
App::forbid_access("/me");

$message = new Message();

// Checa se o usuário está realmente logado
if (!App::check_auth()) {
	App::set_message(new Message(MessagePatterns::NotLogged), "/");
}

$user = new User($_POST['email'], "");

$controller = new UserController($message, $user);
$controller->updateEmail();

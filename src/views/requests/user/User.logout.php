<?php
require_once __SRC__ . "/controllers/User.controller.php";

$message = new Message();

// Checa se o usuário está realmente logado
if (!App::check_auth()) {
	$message->not_auth();
	App::set_message($message, "/");
}

$user = new User($_SESSION['LOGIN']['email'], "");

$controller = new UserController($message, $user);
$controller->logout();

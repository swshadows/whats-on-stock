<?php
require_once __SRC__ . "/controllers/User.controller.php";
App::forbid_access("/");

$message = new Message();

// Checa se o usuário está realmente logado
if (!App::check_auth()) {
	$message->not_auth();
	App::set_message($message, "/");
}

$controller = new UserController($message, new User("", ""));
$controller->deleteUser();

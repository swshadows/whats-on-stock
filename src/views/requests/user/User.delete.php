<?php
require_once __SRC__ . "/controllers/User.controller.php";
App::forbid_access("/");

// Checa se o usuário está realmente logado
if (!App::check_auth()) {
	App::set_message(new Message(MessagePatterns::NotLogged), "/");
}

$controller = new UserController(new User($_SESSION['LOGIN']['email'], ""));
$controller->deleteUser();

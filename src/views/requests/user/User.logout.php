<?php
require_once __SRC__ . "/controllers/User.controller.php";


// Checa se o usuário está realmente logado
if (!App::check_auth()) {
	App::set_message(new Message(MessagePatterns::NotLogged), "/");
}

$user = new User($_SESSION['LOGIN']['email'], "");

$controller = new UserController($user);
$controller->logout();

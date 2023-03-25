<?php
require_once __SRC__ . "/controllers/User.controller.php";
App::forbid_access("/");

$user = new User($_POST['email'], $_POST['password']);
$message = new Message();

$controller = new UserController($message, $user);
$controller->registerUser($_POST['password-repeat']);

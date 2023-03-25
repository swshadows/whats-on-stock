<?php
require_once __SRC__ . "/controllers/User.controller.php";
App::forbid_access("/");

$message = new Message();

$user = new User($_POST['email'], $_POST['password']);

$controller = new UserController($message, $user);
$controller->login();

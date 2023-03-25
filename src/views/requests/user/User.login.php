<?php
require_once __SRC__ . "/controllers/User.controller.php";
App::forbid_access("/");

$user = new User($_POST['email'], $_POST['password']);

$controller = new UserController($user);
$controller->login();

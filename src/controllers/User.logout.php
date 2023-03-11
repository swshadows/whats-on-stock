<?php
require_once "App.controller.php";
require __SRC__ . '/utils/messages.php';

$message = new Message();

$is_logged = App::check_auth();


if ($is_logged) {
	unset($_SESSION['LOGIN']);
	$message->logout_success();
	App::set_message($message, "/");
} else {
	$message->not_auth();
	App::set_message($message, "/");
}

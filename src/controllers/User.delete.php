<?php
require_once "App.controller.php";
require __SRC__ . '/models/UserDAO.php';
require __SRC__ . '/utils/messages.php';

$message = new Message();

$is_logged = App::check_auth();

if (!$is_logged) {
	$message->not_auth();
	App::set_message($message->get_type(), $message->get_message(), "/");
}
$user = new User($_SESSION['LOGIN'], "");
$user_dao = new UserDAO();

$user_dao->delete($user->get_email());
unset($_SESSION['LOGIN']);

$message->user_delete_success();
App::set_message($message->get_type(), $message->get_message(), "/");

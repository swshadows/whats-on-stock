<?php
require 'App.controller.php';
require __SRC__ . '/models/ItemDAO.php';
require __SRC__ . '/utils/messages.php';

$message = new Message();

$id = intval($_POST['id']);

$item_dao = new ItemDAO();

// Checa se o usuário logado é o dono do item
if (!$item_dao->check_owner($id)) {
	$message->user_not_owner();
	App::set_message($message, "/app");
}

$item_dao->delete($id);

$message->delete_item_success();
App::set_message($message, "/app");

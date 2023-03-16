<?php
require 'App.controller.php';
require __SRC__ . '/models/ItemDAO.php';
require __SRC__ . '/utils/messages.php';

$message = new Message();

$name = $_POST['name'];
$id = $_POST['id'];

$item = new Item($name, 0);

// Checa se o nome está vazio
if (!$item->validate_name()) {
	$message->item_name_empty();
	App::set_message($message, "/app");
}


$item_dao = new ItemDAO();
$item_dao->update_name($id, $item->get_name());

$message->item_update_success();
App::set_message($message, "/app");

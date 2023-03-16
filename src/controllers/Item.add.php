<?php
require 'App.controller.php';
require __SRC__ . '/models/ItemDAO.php';
require __SRC__ . '/utils/messages.php';

$message = new Message();

$name = $_POST['name'];
$qty = intval($_POST['qty']);

$item = new Item($name, $qty);

// Checa se o nome está vazio
if (!$item->validate_name()) {
	$message->item_name_empty();
	App::set_message($message, "/app");
}

// Checa se a quantidade está vazio
if (!$item->validate_qty()) {
	$message->item_qty_empty();
	App::set_message($message, "/app");
}

$item_dao = new ItemDAO();
$item_dao->create($item);

$message->item_add_success();
App::set_message($message, "/app");

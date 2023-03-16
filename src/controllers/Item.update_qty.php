<?php
require 'App.controller.php';
require __SRC__ . '/models/ItemDAO.php';
require __SRC__ . '/utils/messages.php';

$message = new Message();

$qty = intval($_POST['qty']);
$id = $_POST['id'];

$item = new Item("", $qty);

// Checa se a quantidade está vazio
if (!$item->validate_qty()) {
	$message->item_qty_empty();
	App::set_message($message, "/app");
}

$item_dao = new ItemDAO();

// Checa se o usuário logado é o dono do item
if (!$item_dao->check_owner($id)) {
	$message->user_not_owner();
	App::set_message($message, "/app");
}

$item_dao->update_qty($id, $item->get_qty());

$message->item_update_success();
App::set_message($message, "/app");

<?php
require 'App.controller.php';
require __SRC__ . '/models/ItemDAO.php';
require __SRC__ . '/utils/messages.php';

$message = new Message();

$id = intval($_POST['id']);

$item_dao = new ItemDAO();

$item_dao->delete($id);

$message->delete_item_success();
App::set_message($message, "/app");

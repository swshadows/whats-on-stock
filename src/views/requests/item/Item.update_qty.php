<?php
require_once __SRC__ . "/controllers/Item.controller.php";
App::forbid_access("/app");

$message = new Message();

$qty = intval($_POST['qty']);
$item = new Item("", intval($_POST['qty']));

$controller = new ItemController($message, $item);
$controller->updateQty($_POST['id']);

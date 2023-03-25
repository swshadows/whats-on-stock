<?php
require_once __SRC__ . "/controllers/Item.controller.php";
App::forbid_access("/app");

$qty = intval($_POST['qty']);
$item = new Item("", intval($_POST['qty']));

$controller = new ItemController($item);
$controller->updateQty($_POST['id']);

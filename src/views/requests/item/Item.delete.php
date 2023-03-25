<?php
require_once __SRC__ . "/controllers/Item.controller.php";
App::forbid_access("/app");

$message = new Message();

$controller = new ItemController($message, new Item("", 0));
$controller->deleteItem(intval($_POST['id']));

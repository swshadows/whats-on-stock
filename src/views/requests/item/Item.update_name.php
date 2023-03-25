<?php
require_once __SRC__ . "/controllers/Item.controller.php";
App::forbid_access("/app");

$message = new Message();

$item = new Item($_POST['name'], 0);

$controller = new ItemController($message, $item);
$controller->updateName($_POST['id']);

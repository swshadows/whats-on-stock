<?php
require_once __SRC__ . "/controllers/Item.controller.php";
App::forbid_access("/app");

$controller = new ItemController(new Item("", 0));
$controller->deleteItem(intval($_POST['id']));

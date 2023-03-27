<?php
require_once __SRC__ . "/controllers/App.controller.php";
require_once __SRC__ . "/utils/Message.php";

if (!App::check_auth()) {
	App::set_message(new Message(MessagePatterns::NotLogged), "/");
}

require_once __SRC__ . "/models/ItemDAO.php";
$item_dao = new ItemDAO();
$arr = [
	"user" => $_SESSION['LOGIN']['email'],
	"data" => []
];

$arr['data'] = $item_dao->find_all();

foreach ($arr['data'] as $key => &$item) {
	unset($item['user_id']);
}

header("Content-Type: application/json");
echo json_encode($arr);

<?php
require __SRC__ . "/controllers/App.controller.php";
require __SRC__ . "/utils/messages.php";

$message = new Message();

$message->page_dont_exist();
App::set_message($message, "/");

<?php
define('__SRC__', dirname(__DIR__) . '/src');
define('__APP__', dirname(__DIR__) . '/app');

require_once __SRC__ . '/routes/routes.php';

$render = Router::route($_SERVER['REQUEST_URI']);

require_once __SRC__ . $render;

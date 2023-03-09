<?php
// Diretórios
define('__ROOT__', dirname(__DIR__));
define('__SRC__', __ROOT__ . '/src');
define('__APP__', __ROOT__ . '/app');

// Nomes
define('__NAME__', "What's on Stock?");

require_once __SRC__ . '/routes/routes.php';

$render = Router::route($_SERVER['REQUEST_URI']);

require_once __SRC__ . $render;

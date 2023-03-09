<?php
require_once 'Router.php';

Router::register('/', '/views/index.php');

Router::register('/user/create', '/controllers/User.register.php');

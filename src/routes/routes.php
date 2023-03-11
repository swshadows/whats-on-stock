<?php
require_once 'Router.php';

Router::register('/', '/views/index.php');
Router::register('/app', '/views/app.php');
Router::register('/me', '/views/user_update.php');

Router::register('/user/create', '/controllers/User.register.php');
Router::register('/user/login', '/controllers/User.login.php');
Router::register('/user/logout', '/controllers/User.logout.php');

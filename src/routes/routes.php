<?php
require_once 'Router.php';

Router::register('/', '/views/index.php');
Router::register('/app', '/views/app.php');
Router::register('/me', '/views/me.php');

Router::register('/user/create', '/controllers/User.register.php');
Router::register('/user/update_email', '/controllers/User.update_email.php');
Router::register('/user/update_password', '/controllers/User.update_password.php');
Router::register('/user/delete', '/controllers/User.delete.php');
Router::register('/user/login', '/controllers/User.login.php');
Router::register('/user/logout', '/controllers/User.logout.php');

Router::register('/item/add', '/controllers/Item.add.php');
Router::register('/item/delete', '/controllers/Item.delete.php');
Router::register('/item/update_name', '/controllers/Item.update_name.php');
Router::register('/item/update_qty', '/controllers/Item.update_qty.php');

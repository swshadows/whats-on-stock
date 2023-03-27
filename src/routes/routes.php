<?php
require_once 'Router.php';

Router::register('/', '/views/index.php');
Router::register('/app', '/views/app.php');
Router::register('/me', '/views/me.php');

Router::register('/user/create', '/views/requests/user/User.register.php');
Router::register('/user/update_email', '/views/requests/user/User.update_email.php');
Router::register('/user/update_password', '/views/requests/user/User.update_password.php');
Router::register('/user/delete', '/views/requests/user/User.delete.php');
Router::register('/user/login', '/views/requests/user/User.login.php');
Router::register('/user/logout', '/views/requests/user/User.logout.php');

Router::register('/item/add', '/views/requests/item/Item.add.php');
Router::register('/item/update_name', '/views/requests/item/Item.update_name.php');
Router::register('/item/update_qty', '/views/requests/item/Item.update_qty.php');
Router::register('/item/delete', '/views/requests/item/Item.delete.php');

Router::register('/export/json', '/views/exports/json.php');
Router::register('/export/pdf', '/views/exports/pdf.php');

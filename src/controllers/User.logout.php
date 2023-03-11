<?php

require_once "App.controller.php";

if (isset($_COOKIE['login_info'])) {
	unset($_COOKIE['login_info']);
	setcookie("login_info", "", time() - 3600, "/");
	App::set_message("success", "✅ Você fez logout e foi redirecionado", "/");
} else {
	App::set_message("error", "❌ Você não está logado ainda", "/");
}

<?php

require_once "App.controller.php";

if (isset($_SESSION['LOGIN'])) {
	unset($_SESSION['LOGIN']);
	App::set_message("success", "✅ Você fez logout e foi redirecionado", "/");
} else {
	App::set_message("error", "❌ Você não está logado ainda", "/");
}
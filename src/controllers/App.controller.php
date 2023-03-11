<?php
session_start();

class App
{
	// Checa se o usuário está autenticado
	public static function check_auth()
	{
		if (isset($_SESSION['LOGIN'])) {
			return true;
		} else {
			return false;
		}
	}

	// Redireciona para determinada página
	public static function redirect($to)
	{
		header("Location: $to");
		exit;
	}

	// Seta uma mensagem temporária na sessão
	public static function set_message($msg_type = "error" || "success", $msg_string, $optional_path = null)
	{
		$_SESSION['MESSAGE'] = ['type' => $msg_type, 'string' => $msg_string];
		if ($optional_path) {
			self::redirect($optional_path);
		}
	}
}

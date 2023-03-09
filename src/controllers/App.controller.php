<?php
session_start();

class App
{
	// Compara duas senhas
	public static function compare_passwords($pswd, $pswd_repeat)
	{
		if ($pswd == $pswd_repeat) {
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
	public static function set_message($msg_type = "error" || "success", $msg_string)
	{
		$_SESSION['MESSAGE'] = ['type' => $msg_type, 'string' => $msg_string];
	}
}

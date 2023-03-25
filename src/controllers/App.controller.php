<?php

class App
{
	// Não permite acesso direto a arquivos de request
	public static function forbid_access($redirect)
	{
		$message = new Message();
		if (!$_POST) {
			$message->forbidden();
			App::set_message($message, $redirect);
		}
	}
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

	// Retorna o REQUEST_URI formatado
	public static function get_req_uri()
	{
		$format = explode("?", $_SERVER['REQUEST_URI']);
		return $format[0];
	}

	// Seta uma mensagem temporária na sessão
	public static function set_message(Message $msg, $optional_path = null)
	{
		$_SESSION['MESSAGE'] = ['type' => $msg->get_type(), 'string' => $msg->get_message()];
		if ($optional_path) {
			self::redirect($optional_path);
		}
	}
}

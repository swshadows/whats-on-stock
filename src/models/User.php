<?php

class User
{
	private string $email;
	private string $password;

	public function __construct($em, $ps)
	{
		$this->email = $em;
		$this->password = $ps;
	}

	// Getters
	public function get_email()
	{
		return $this->email;
	}
	public function get_password()
	{
		return $this->password;
	}

	// Setters
	public function set_email($var)
	{
		$this->email = $var;
	}
	public function set_password($var)
	{
		$this->password = $var;
	}

	// Valida o email
	public function validate_email()
	{
		if (filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
			return true;
		} else {
			return false;
		}
	}

	// Transforma a senha em um hash
	public function set_password_hash()
	{
		$hash = password_hash($this->password, PASSWORD_DEFAULT);
		$this->password = $hash;
	}

	// Checa se a senha do usuário e a repetição são iguais
	public function compare_passwords($pswd_repeat)
	{
		if ($this->password == $pswd_repeat) {
			return true;
		} else {
			return false;
		}
	}

	// Checa se o hash da senha 
	public function dehash_password($hash)
	{
		if (password_verify($this->password, $hash)) {
			return true;
		}
		return false;
	}

	// Checa se a senha é segura
	public function check_password_safe()
	{
		$password_size = strlen($this->password);
		// Checa se a senha é maior que 8 e menor que 255 caracteres
		if (!($password_size >= 8) || !($password_size <= 255)) {
			return MessagePatterns::PasswordSizeInvalid;
		}

		// Checa se a senha contem pelo menos um número
		if (!preg_match("#[0-9]+#", $this->password)) {
			return MessagePatterns::PasswordHasNoNumber;
		}

		// Checa se a senha contem pelo menos uma letra maiuscula
		if (!preg_match("#[A-Z]+#", $this->password)) {
			return MessagePatterns::PasswordHasNoUppercase;
		}

		// Checa se a senha contem pelo menos uma letra minuscula
		if (!preg_match("#[a-z]+#", $this->password)) {
			return MessagePatterns::PasswordHasNoLowercase;
		}

		// Checa se a senha contem pelo menos um simbolo
		if (!preg_match("#[\ \!\"\#\$\%\&\'\(\)\*\+\,-\.\\\/\:\;\<\=\>\?\@\[\]\^\_\`\{\|\}\~]+#", $this->password)) {
			return MessagePatterns::PasswordHasNoSymbol;
		}

		return true;
	}
}

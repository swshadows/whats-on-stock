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

	// Checa se a senha é maior que 8 caracteres e menor que 255 caracteres
	public function check_password_safe()
	{
		$password_size = strlen($this->password);
		if ($password_size >= 8 && $password_size <= 255) {
			return true;
		} else {
			return false;
		}
	}
}

interface UserDAOInterface
{
	public function create(User $user);
	public function find_all();
	public function find_by_email(string $email);
	public function update(User $user);
	public function delete(int $id);
}

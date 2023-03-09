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
}

interface UserDAOInterface
{
	public function create(User $user);
	public function find_all();
	public function find_by_id(int $id);
	public function update(User $user);
	public function delete(int $id);
}

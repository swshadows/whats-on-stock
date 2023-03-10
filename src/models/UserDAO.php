<?php

require 'User.php';
require 'PDO.php';


class UserDAO implements UserDAOInterface
{
	private PDO $connection;

	public function __construct()
	{
		$conn = new PDOConnection();
		$this->connection = $conn->connect();
	}

	public function create(User $user)
	{
		$query = "INSERT INTO users(email, password) VALUES (:email, :password)";
		$sttm = $this->connection->prepare($query);
		$sttm->bindValue(':email', $user->get_email());
		$sttm->bindValue(":password", $user->get_password());
		$sttm->execute();
	}

	public function find_all()
	{
	}

	public function find_by_email(string $email)
	{
		$query = "SELECT * FROM users WHERE email=:email";
		$stmt = $this->connection->prepare($query);
		$stmt->bindValue(":email", $email);
		$stmt->execute();
		$data = $stmt->fetch(PDO::FETCH_ASSOC);

		return $data;
	}
	public function update(User $user)
	{
	}
	public function delete(int $id)
	{
	}
}

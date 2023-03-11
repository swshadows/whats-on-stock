<?php

require 'User.php';
require 'PDO.php';


class UserDAO
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

	public function update_email(string $prev_em, string $new_em)
	{
		$query = "UPDATE users SET email = :email WHERE email = :previous_email";
		$stmt = $this->connection->prepare($query);
		$stmt->bindValue(":email", $new_em);
		$stmt->bindValue(":previous_email", $prev_em);
		$stmt->execute();
	}
	public function update_password(string $em, string $new_pwsd)
	{
		$query = "UPDATE users SET password = :password WHERE email = :email";
		$stmt = $this->connection->prepare($query);
		$stmt->bindValue(":password", $new_pwsd);
		$stmt->bindValue(":email", $em);
		$stmt->execute();
	}

	public function delete(string $em)
	{
		$query = "DELETE FROM users WHERE email = :email";
		$stmt = $this->connection->prepare($query);
		$stmt->bindValue(":email", $em);
		$stmt->execute();
	}
}

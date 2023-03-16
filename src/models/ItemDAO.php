<?php

require 'Item.php';
require 'PDO.php';


class ItemDAO
{
	private PDO $connection;

	public function __construct()
	{
		$conn = new PDOConnection(__ROOT__ . "/.env");
		$this->connection = $conn->connect();
	}

	public function create(Item $item)
	{
		$query = "INSERT INTO items(name, qty) VALUES (:name, :qty)";
		$sttm = $this->connection->prepare($query);
		$sttm->bindValue(':name', $item->get_name());
		$sttm->bindValue(":qty", $item->get_qty());
		$sttm->execute();
	}

	public function find_all()
	{
		$query = "SELECT * FROM items WHERE user_id=:id";
		$stmt = $this->connection->prepare($query);
		$stmt->bindValue(":id", $_SESSION['LOGIN']['id']);
		$stmt->execute();
		$data = $stmt->fetch(PDO::FETCH_ASSOC);

		return $data;
	}


	public function update_name(int $id, string $name)
	{
		$query = "UPDATE items SET name = :name WHERE id = :id";
		$stmt = $this->connection->prepare($query);
		$stmt->bindValue(":name", $name);
		$stmt->bindValue(":id", $id);
		$stmt->execute();
	}
	public function update_qty(int $id, int $qty)
	{
		$query = "UPDATE items SET qty = :qty WHERE id = :id";
		$stmt = $this->connection->prepare($query);
		$stmt->bindValue(":qty", $qty);
		$stmt->bindValue(":id", $id);
		$stmt->execute();
	}

	public function delete(int $id)
	{
		$query = "DELETE FROM items WHERE id = :id";
		$stmt = $this->connection->prepare($query);
		$stmt->bindValue(":id", $id);
		$stmt->execute();
	}
}

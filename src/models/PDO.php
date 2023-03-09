<?php

class PDOConnection
{
	private string $user;
	private string $password;
	private string $host;
	private string $db_name;

	public function __construct()
	{
		$env = parse_ini_file(__ROOT__ . "/.env");
		$this->user = $env["USERNAME"];
		$this->password = $env["PASSWORD"];
		$this->host = $env["HOST"];
		$this->db_name = $env["DB"];
	}

	public function connect()
	{
		$dsn = "mysql:host=$this->host;dbname=$this->db_name";
		try {
			$pdo = new PDO($dsn, $this->user, $this->password);
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			return $pdo;
		} catch (PDOException $e) {
			$error = $e->getMessage();
			echo "ERRO: $error";
		}
	}
}

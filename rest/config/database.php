<?php

include('config.php');

class Database
{
	public $conn;

	public function getConnection(): ?PDO
	{
		$this->conn = null;
		try {
			$this->conn = new PDO("mysql:host=" . Config::$db_host . ";dbname=" . Config::$db_name, Config::$db_username, Config::$db_password);
			$this->conn->exec("set names utf8");
			if (!empty(Config::$db_statement_0)) {
				$this->conn->exec(Config::$db_statement_0);
			}
		} catch (PDOException $exception) {
			echo "Connection error: " . $exception->getMessage();
		}
		return $this->conn;
	}

	function getUserByEmailAndPassword($email_, $pass_)
	{
		$query = "SELECT u.id, u.email, u.name, r.name as role FROM pd_user u, pd_role r WHERE " .
			"u.email = '" . $email_ . "' AND u.pass = '" . $pass_ . "' and u.role = r.id";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		return $stmt;
	}
}


<?php

include_once '../config/database.php';
include_once '../models/category.php';
include_once '../config/config.php';

class CategoryService
{
	private $database;
	private $connection;
	private $category;

	public function __construct()
	{
		$this->database = new Database();
		$this->connection = $this->database->getConnection();
		$this->category = new Category($this->connection);
	}

	function getAll(): ?array
	{
		return $this->category->findAll();
	}
}

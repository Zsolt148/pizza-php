<?php

namespace Database;

use Exception;
use PDO;
use PDOException;

class Sql
{
	private $host;
	private $port;
	private $user;
	private $pass;
	private $database;

	/**
	 * @var PDO $pdo
	 */
	private PDO $pdo;

	/**
	 * @return static
	 */
	public static function make()
	{
		return (new static);
	}

	/**
	 * @param $host
	 * @param $port
	 * @param $user
	 * @param $pass
	 * @param $database
	 * @return $this
	 */
	public function setConnection($host, $port, $user, $pass, $database) : self
	{
		$this->host = $host;
		$this->port = $port;
		$this->user = $user;
		$this->pass = $pass;
		$this->database = $database;

		return $this;
	}

	/**
	 * @return $this
	 * @throws Exception
	 */
	public function makeConnection()
	{

		$dsn = 'mysql:host=' . $this->host . ';port=' . $this->port . ';dbname=' . $this->database . ';charset=utf8';

		try {
			$this->pdo = new PDO($dsn, $this->user, $this->pass);
			$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			return $this;

		} catch(PDOException $e) {
			echo "Sikertelen SQL kapcsolodás: " . $e->getMessage() . "<br>";
			throw new Exception($e->getMessage());
		}
	}

	/**
	 * @return PDO
	 */
	public function getPdo() : PDO
	{
		return $this->pdo;
	}
}

?>
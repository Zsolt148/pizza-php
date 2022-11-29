<?php 
namespace App\Models;

use App\Interfaces\CrudInterface;
use App\Interfaces\ModelInterface;
use Database\Sql;
use Exception;
use PDO;

abstract class Model implements ModelInterface, CrudInterface
{
	/**
	 * Fillable fields in the database
	 *
	 * @var array
	 */
	protected $fillable = [];

	/**
	 * It represents a PDO instance
	 *
	 * @var object
	 */
	protected static $db = null;

	/**
	 * The name of the table in the database that the model binds
	 *
	 * @var string
	 */
	protected $table = null;

	/**
	 * @var string
	 */
	protected $primaryKey = 'id';

	/**
	 * @var int
	 */
	protected $fetchMode = PDO::FETCH_ASSOC;

	/**
	 * The model construct.
	 *
	 * Table must be set
	 * Creates PDO DB
	 */
	public function __construct()
	{
		// protected $table must be set
		if(!$this->table) {
			throw new Exception("Model table is not set");
		}

		// Set static db
		if (static::$db === null) {
			static::$db = Sql::make()
				->setConnection(DB_HOST, DB_PORT, DB_USER, DB_PASS, DB_NAME)
				->makeConnection()
				->getPdo();
		}
	}

	/**
	 * @return static
	 */
	public static function query()
	{
		return (new static);
	}

	/**
	 * @return string
	 */
	public function getPrimaryKey() : string
	{
		return $this->primaryKey;
	}

	/**
	 * @param string $query
	 * @param        $fetch
	 * @return mixed
	 */
	public function raw(string $query, $fetch = 'fetchAll')
	{
		return $this->db()
			->query($query)
			->{$fetch}($this->fetchMode);
	}

	/**
	 * Method for getting all records from database.
	 *
	 * @return array
	 */
	public function getAll($joins = null) : iterable
	{
		$query = "SELECT * FROM {$this->table}";

		if($joins) {
			$query .= " " . $joins;
		}

		return $this->db()
			->query($query)
			->fetchAll($this->fetchMode);
	}

	/**
	 * Find record by id or key-value pair
	 *
	 * @param $idOrKey // id or key
	 * @param null $value
	 * @return mixed
	 */
	public function find($idOrKey, $value = null)
	{
		$key = $this->getPrimaryKey();

		// Only first param is given then find by primaryKey
		if($idOrKey && !$value) {
			$value = $idOrKey;
		}

		// String and value is given
		if(is_string($idOrKey) && $value) {
			$key = $idOrKey;
		}

		return $this->db()
			->query("SELECT * FROM {$this->table} WHERE $key = '$value'")
			->fetch($this->fetchMode);
	}

	/**
	 * Find record by id or key-value pair
	 * Aborts (404) when the record is not found
	 *
	 * @param $idOrKey // id or key
	 * @param null $value
	 * @return mixed
	 */
	public function findOrFail($idOrKey, $value = null)
	{
		$data = $this->find($idOrKey, $value);

		abort_if(!$data);

		return $data;
	}

	/**
	 * Find record by an array of parameters
	 * 
	 * @param array $params A set of parameters
	 * @return mixed
	 */
	public function findByArray(array $params)
	{
		$query = "SELECT * FROM {$this->table} WHERE ";
		$i = 0;
		$keys = array_keys($params);
		foreach($params as $param)
		{
			if($i > 0)
			{
				$query = $query . "AND ";
			}

			$query = $query . "$keys[$i] = '$param' ";
			$i = $i + 1;
		}
		
		return $this->db()
			->query($query)
			->fetch($this->fetchMode);
	}

	/**
	 * The insert method.
	 *
	 * @param array $data A set of data to be added to the database.
	 *
	 * @return integer The last insert ID
	 */
	public function insert(array $data) : int
	{
		// Question marks
		$marks = array_fill(0, count($data), '?');
		// Fields to be added.
		$fields = array_keys($data);
		$this->checkFillableFields($fields);
		// Fields values
		$values = array_values($data);

		// Prepare statement
		$stmt = $this->db()
			->prepare("
				INSERT INTO {$this->table} (" . implode(",", $fields) . ")
				VALUES(" . implode(",", $marks) . ")
			");

		// Execute statement with values
		$stmt->execute($values);

		// Return last inserted ID.
		return $this->db()->lastInsertId();
	}

	/**
	 * The update method.
	 *
	 * @param int $id The ID of the model to be updated.
	 * @param array $data A set of data to be updated to the database.
	 *
	 * @return integer The updated ID
	 */
	public function update(int $id, array $data) : int
	{
		$this->findOrFail($id);

		// Fields to be added.
		$set = [];
		$fields = array_keys($data);

		$this->checkFillableFields($fields);

		foreach($fields as $field) {
			$set[] = "$field = :$field";
		}

		// Prepare statement
		$stmt = $this->db()
			->prepare("
				UPDATE {$this->table} SET " . implode(", ", $set) . "
				WHERE id = '$id'
			");

		// Execute statement with values
		$stmt->execute($data);

		// Return last updated ID.
		return $this->db()->lastInsertId();
	}

	/**
	 * @param int $id
	 * @return bool
	 */
	public function delete(int $id) : bool
	{
		$this->findOrFail($id);

		// Prepare statement
		$stmt = $this->db()
			->prepare("
				DELETE FROM {$this->table}
				WHERE id = '$id'
			");

		// Execute statement
		return $stmt->execute();
	}

	/**
	 * The method return a PDO database connection.
	 *
	 * @return object
	 */
	public function db() : PDO
	{
		return static::$db;
	}

	/**
	 * @param array $fields
	 * @return void
	 * @throws Exception
	 */
	private function checkFillableFields(array $fields) : void
	{
		if(!arrays_equals($this->fillable, $fields)) {
			throw new Exception(
				"Fillable model fields are not same as create/update SQL fields.
				Trying to fill: " . implode(', ', $fields) . "
				(Fillable fields: " . implode(', ', $this->fillable) . ")."
			);
		}
	}
}
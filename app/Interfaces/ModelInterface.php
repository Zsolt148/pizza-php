<?php 
namespace App\Interfaces;

use PDO;

interface ModelInterface
{
	public static function query() : static;

    public function getId() : int;

	public function db(): PDO;
}
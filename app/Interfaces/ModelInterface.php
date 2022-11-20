<?php 
namespace App\Interfaces;

use PDO;

interface ModelInterface
{
	public static function query() : static;

    public function getPrimaryKey() : string;

	public function db(): PDO;
}
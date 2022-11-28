<?php 
namespace App\Interfaces;

use PDO;

interface ModelInterface
{
	public static function query();

    public function getPrimaryKey() : string;

	public function db(): PDO;
}
<?php

namespace App\Models;

use PDO;

class User extends Model
{
	protected $table = 'users';

	protected $fillable = [
		'name',
		'email',
		'role',
		'password',
	];

	const ROLE_USER = 'user';
	const ROLE_ADMIN = 'admin';

	const ROLES = [
		self::ROLE_USER => 'user',
		self::ROLE_ADMIN => 'admin'
	];

	/**
	 * The model construct
	 */
	public function __construct() {
		parent::__construct();
	}

	public function isUser()
	{
		return $this->role == self::ROLE_USER;
	}

	public function isAdmin()
	{
		return $this->role == self::ROLE_ADMIN;
	}
}
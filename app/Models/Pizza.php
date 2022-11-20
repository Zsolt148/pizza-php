<?php

namespace App\Models;

class Pizza extends Model
{
	protected $table = 'pizzas';
	protected $primaryKey = 'name';

	protected $fillable = [
		'name',
		'category_name',
		'is_vegetarian',
	];

	/**
	 * The model construct
	 */
	public function __construct() {
		parent::__construct();
	}
}
<?php

namespace App\Models;

class Category extends Model
{
	protected $table = 'categories';
	protected $primaryKey = 'name';

	protected $fillable = [
		'name',
		'price',
	];

	/**
	 * The model construct
	 */
	public function __construct() {
		parent::__construct();
	}
}
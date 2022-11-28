<?php

namespace App\Controllers;

use App\Helpers\RouteCollection;
use App\Models\Pizza;

class PizzaController extends Controller
{
	protected $folder = 'pizzas';

	/**
	 * @param RouteCollection $routes
	 */
	public function __construct(RouteCollection $routes)
	{
		parent::__construct($routes);
	}

	/**
	 * @return mixed
	 */
	public function index()
	{
		$pizzas = Pizza::query()
			->raw("
				SELECT pizzas.*, categories.name AS cat_name, categories.price AS cat_price
				FROM pizzas
				INNER JOIN categories ON pizzas.category_name=categories.name
				ORDER BY pizzas.name
			");

		return $this->view('index', [
			'pizzas' => $pizzas
		]);
	}

	/**
	 * @return mixed
	 */
	public function create()
	{
		abort_if(!auth()->check());

		return $this->view('create');
	}

	/**
	 * @return mixed|void
	 */
	public function store()
	{
		abort_if(!auth()->check());

		try {
			$validated = $this->validate($this->rules());

		} catch(Exception $e) {
			return $this->view('create', [
				'errors' => $e->getMessage()
			]);
		}

		Pizza::query()->insert($validated);

		return redirect(route($this->routes->get('pizzas.index')), 'Successfully created');
	}

	/**
	 * @return array
	 */
	private function rules()
	{
		return [
			'name' => ['required', 'string'],
			'category_name' => ['required'],
			'is_vegetarian' => ['nullable']
		];
	}
}
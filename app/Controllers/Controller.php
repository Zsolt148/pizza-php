<?php

namespace App\Controllers;

use App\Helpers\Input;
use App\Helpers\RouteCollection;

abstract class Controller
{
	/**
	 * @var RouteCollection
	 */
	protected RouteCollection $routes;

	protected $post;

	/**
	 * Folder prefix for view
	 * @var string
	 */
	protected $folder = null;

	/**
	 * @param RouteCollection $routes
	 */
	public function __construct(RouteCollection $routes)
	{
		$this->routes = $routes;
		$this->post = $_POST;
	}

	public static function resolve(RouteCollection $routes)
	{
		return (new static($routes));
	}

	/**
	 * @param array $rules
	 * @return array
	 */
	public function validate(array $rules, $data = null)
	{
		$post = $data ?: $this->post;
		$validated = [];

		foreach($rules as $field => $rule) {

			// If rules are set like this: 'required|string'
			if(is_string($rule) && str_contains($rule, '|')) {
				$rule = explode('|', $rule);
			}

			if(is_string($rule)) {
				$valid = Input::{$rule}($field, $post[$field]);
				$validated[$field] = $valid;
				continue;
			}

			if(is_array($rule)) { // array of rules is given
				foreach($rule as $r) {
					$valid = Input::{$r}($field, $post[$field]);
					$validated[$field] = $valid; // overwrites key
				}
			}
		}

		return $validated;
	}

	/**
	 * @param string 	$view
	 * @param array 	$variables - key/value pairs
	 * @return mixed
	 */
	public function view(string $view, array $variables = [])
	{
		$routes = $this->routes;

		// Load variables for require_once view
		foreach($variables as $name => $data) {
			$$name = $data;
		}

		if(!str_contains($view, '.php')) {
			$view .= '.php';
		}

		if($folder = $this->folder) {
			$view = $folder . DIRECTORY_SEPARATOR . $view;
		}

		return require_once view($view);
	}
}
<?php

namespace App\Helpers;

use Exception;

class Route
{
	public string $path = '/';
	private $controller;
	private $func;

	/**
	 * @var string $method
	 */
	private $method = 'GET';

	/**
	 * @param string $path
	 * @param array  $action
	 */
	public function __construct(string $path, array $action)
	{
		if(!isset($action[0]) || !isset($action[1])) {
			throw new Exception("Route controller or function is not set");
		}

		$this->path = $path;
		$this->controller = $action[0];
		$this->func = $action[1];
	}

	/**
	 * @param string $path
	 * @param array  $action
	 * @return Route
	 */
	public static function get(string $path = '/', array $action = [])
	{
		return (new static($path, $action))
			->setMethod('GET');
	}

	/**
	 * @param string $path
	 * @param array  $action
	 * @return Route
	 */
	public static function post(string $path = '/', array $action = [])
	{
		return (new static($path, $action))
			->setMethod('POST');
	}

	/**
	 * @param string $path
	 * @param array  $action
	 * @return Route
	 */
	public static function put(string $path = '/', array $action = [])
	{
		return (new static($path, $action))
			->setMethod('PUT');
	}

	/**
	 * @param string $path
	 * @param array  $action
	 * @return Route
	 */
	public static function delete(string $path = '/', array $action = [])
	{
		return (new static($path, $action))
			->setMethod('DELETE');
	}

	/**
	 * @param RouteCollection $routes
	 * @param                 ...$args
	 * @return void
	 */
	public function handle(RouteCollection $routes, $method, ...$args)
	{
		$controller = $this->controller::resolve($routes);

		if($this->method !== $method) {
			throw new Exception("Method [$method] is not allowed. Allowed methods: $this->method");
		}

		//call_user_func([$controller, $this->func], $args);
		call_user_func_array([$controller, $this->func], $args);
	}

	/**
	 * @return string
	 */
	public function getPath() : string
	{
		return $this->path;
	}

	/**
	 * @param string $path
	 * @return $this
	 */
	public function setPath(string $path) : self
	{
		$this->path = $path;

		return $this;
	}

	/**
	 * @param $method
	 * @return $this
	 */
	public function setMethod($method) : self
	{
		$this->method = $method;

		return $this;
	}
}
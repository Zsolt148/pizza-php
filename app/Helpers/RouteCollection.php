<?php

namespace App\Helpers;

class RouteCollection implements \Countable
{
	/**
	 * @var array<string, Route>
	 */
	private array $routes = [];

	public function count(): int
	{
		return count($this->routes);
	}

	public function all() : array
	{
		return $this->routes;
	}

	public function add(string $name, Route $route)
	{
		unset($this->routes[$name]);

		$this->routes[$name] = $route;
	}

	/**
	 * @param string   $name
	 * @return Route|null
	 */
	public function get(string $name) : ?Route
	{
		// route by key
		if(array_key_exists($name, $this->routes)) {
			return $this->routes[$name];
		}

		// route by path
		foreach($this->routes as $route) {
			if($route->getPath() == $name) {
				return $route;
			}
		}

		return null;
		//throw new \Exception("Route [{$route->getPath()}] not found");
	}
}
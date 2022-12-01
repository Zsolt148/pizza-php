<?php

namespace App\Helpers;

class Router
{
	/**
	 * @param RouteCollection $routes
	 * @return void
	 * @throws \Exception
	 */
	public static function invoke(RouteCollection $routes)
	{
		$method = $_SERVER['REQUEST_METHOD'];
		$uri = parse_url($_SERVER['REQUEST_URI'])['path'];

		$id = (int)filter_var($uri, FILTER_SANITIZE_NUMBER_INT);
		$routeName = preg_replace('/[0-9]+/', '{id}', $uri);

		if($route = $routes->get($routeName)) { // Route instance
			return $route->handle($routes, $method, $id);
		}

		return abort();
	}
}
<?php

use App\Helpers\Auth;
use App\Helpers\ReflectionResolver;
use App\Helpers\Route;

/**
 * @param $class
 * @return object
 * @throws ReflectionException
 */
function app($class) : object
{
	return ReflectionResolver::resolve($class);
}

/**
 * @return Auth
 */
function auth() : Auth
{
	return app(Auth::class);
}

/**
 * @param Route $route
 * @param       $id
 * @return string
 */
function route(Route $route, $id = null) : string
{
 	if(str_contains($route->getPath(), '{id}') !== false) {
 		return str_replace('{id}', $id, $route->getPath());
	}

	return $route->getPath();
}

/**
 * @param string $url
 * @param string $status
 * @return void
 */
function redirect(string $url, string $status = null) : void
{
	if($status) {
		$_SESSION['status'] = $status;
	}

	header('Location: ' . $url, true, 303);
	exit();
}

/**
 * @param $view
 * @return string
 */
function view($view = null) : string
{
    return APP_ROOT . '/resources/views/' . $view;
}

/**
 * Dump and die
 *
 * @param $params
 * @return void
 */
function dd(...$params) : void
{
	echo"<pre>";
	foreach($params as $data) {
		var_dump($data);
		echo"<br>";
	}
	echo"</pre>";

	die();
}

/**
 * @param $code
 * @return void
 */
function abort($code = 404) : void
{
	http_response_code($code);

	die();

	// TODO fix me: return 404.php with routes
	// return require_once abort() where used
	// return view($code . ".php");
}

/**
 * @param $boolean
 * @param $code
 * @return string|void
 */
function abort_if($boolean, $code = 404)
{
	if($boolean) {
		return abort($code);
	}
}

/**
 * Preg match url
 *
 * @param $url
 * @return bool
 */
function isUrl($url) : bool
{
	return (bool) preg_match("/$url/", parse_url($_SERVER['REQUEST_URI'])['path']);
}

/**
 * Checks if current route is current url
 *
 * @param Route $route
 * @return bool
 */
function isRoute(Route $route) : bool
{
	return $route->getPath() == parse_url($_SERVER['REQUEST_URI'])['path'];
}

/**
 * @param array $a
 * @param array $b
 * @return bool
 */
function arrays_equals(array $a, array $b) : bool
{
	return (
		count($a) == count($b) &&
		array_diff($a, $b) === array_diff($b, $a)
	);
}

if (!function_exists('str_contains')) {
	/**
	 * @param $haystack
	 * @param $needle
	 * @return bool
	 */
	function str_contains($haystack, $needle) {
		return $needle !== '' && mb_strpos($haystack, $needle) !== false;
	}
}
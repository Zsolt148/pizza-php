<?php

namespace App\Controllers;

use App\Helpers\Auth;
use App\Helpers\RouteCollection;
use App\Models\User;

class RegisterController extends Controller
{
	/**
	 * @param RouteCollection $routes
	 */
	public function __construct(RouteCollection $routes)
	{
		parent::__construct($routes);
	}

	public function index()
	{
		if(Auth::check()) {
			return redirect(route($this->routes->get('home')));
		}

		return $this->view('register');
	}

	public function register()
	{
		if(Auth::check()) {
			return redirect(route($this->routes->get('home')));
		}

		try {
			$validated = $this->validate([
				'name' => ['required', 'string'],
				'email' => ['required', 'email'],
				'password' => ['required', 'string'],
			]);

			User::query()->insert([
				'name' => $validated['name'],
				'email' => $validated['email'],
				'password' => password_hash($validated['password'], PASSWORD_DEFAULT)
			]);

		} catch(Exception $e) {
			return $this->view('register', [
				'errors' => $e->getMessage()
			]);
		}

		return redirect(route($this->routes->get('login')), 'Successfully registered');
	}
}
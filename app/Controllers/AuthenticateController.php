<?php

namespace App\Controllers;

use App\Helpers\Auth;
use App\Helpers\Input;
use App\Helpers\RouteCollection;
use App\Models\User;
use Exception;

class AuthenticateController extends Controller
{
	/**
	 * @param RouteCollection $routes
	 */
	public function __construct(RouteCollection $routes)
	{
		parent::__construct($routes);
	}

	/**
	 * @return mixed|void
	 */
	public function index()
	{
		if(Auth::check()) {
			return redirect(route($this->routes->get('home')));
		}

		return $this->view('login');
	}

	/**
	 * @return mixed|void
	 */
	public function login()
	{
		if(Auth::check()) {
			return redirect(route($this->routes->get('home')));
		}

		try {
			$validated = $this->validate([
				'email' => ['required', 'email'],
				'password' => ['required', 'string'],
			]);

			// Get user by email
			$user = User::query()
				->find('email', $validated['email']);

			// User by email not found or password does not match
			if(!$user || !password_verify($validated['password'], $user['password'])) {
				Input::throwError('Email or password is incorrect');
			}

			Auth::setSession($user);

		} catch(Exception $e) {
			return $this->view('login', [
				'errors' => $e->getMessage()
			]);
		}

		return redirect(route($this->routes->get('home')));
	}

	/**
	 * @return void
	 */
	public function logout()
	{
		Auth::unsetSession();

		return redirect(route($this->routes->get('home')));
	}
}
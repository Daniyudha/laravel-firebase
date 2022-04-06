<?php

namespace App\Http\Controllers;

use App\Http\Controllers\FirebaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
	public function __construct(FirebaseController $FirebaseController)
	{
		$this->FirebaseController = $FirebaseController;
	}

	public function index()
	{


		return view('login');
	}

	public function home()
	{
		$data = [
			'title' => 'Control Station',
			'temp' => $this->FirebaseController->read()
		];

		return view('home.index', $data);
	}

	public  function doLogout()
	{
		Auth::logout(); // logging out user
		return Redirect::to('/'); // redirection to login screen
	}

	public function doLogin(Request $request)
	{
		// Creating Rules for Email and Password
		$rules = array(
			'email' => 'required|email', // make sure the email is an actual email
			'password' => 'required|alphaNum|min:8'

		);

		$validator = Validator::make(Request::all(), $rules);
		// if the validator fails, redirect back to the form
		if ($validator->fails()) {
			return Redirect::to('/')->withErrors($validator) // send back all errors to the login form
				->withInput(Request::except('password')); // send back the input (not the password) so that we can repopulate the form
		} else {
			if ($request->email = 'admin@mail.com' && $request->password = 'password123') {
				Session::put('login', 'auth');
				return redirect('home');
			}
		}
	}
}

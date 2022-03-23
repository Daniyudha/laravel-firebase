<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\FirebaseController;

class HomeController extends Controller
{
	public function __construct(FirebaseController $FirebaseController)
    {
        $this->FirebaseController=$FirebaseController;
    }

    public function index() {
		$data = [
			'title' => 'Control Station',
			'temp' => $this->FirebaseController->read()
		];

		return view('home.index', $data);
	}
}

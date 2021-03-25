<?php

namespace App\Controllers;

use CodeIgniter\CodeIgniter;
use Error;
use ErrorException;

class Home extends BaseController
{
	// Login Check

	public function index()
	{
		dd(user());
	}
}

// public function cek()
// {
// 	dd(user()->getRoles());
// }
// public function cek2()
// {
// 	dd(in_groups(2));
// }
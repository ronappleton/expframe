<?php

namespace App\Http\Controllers;

use Models\User;

class UserController extends BaseController
{
    public function index()
    {
        dd(User::all());
    }
}

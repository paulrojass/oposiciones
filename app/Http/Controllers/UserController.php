<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;


class UserController extends Controller
{
    public function myProfile()
    {
    	$user = auth()->user();

    	return view('client.panel-user-profile', compact('user'));
    }
}

<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
	{
	    $users = \App\User::orderBy('created_at')->get();
	    return view('admin.user.index')->withUsers($users);
	}
}

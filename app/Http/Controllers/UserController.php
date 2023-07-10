<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    function UsersGetFunctions()
    {
        $users = User::orderBy('id')->get();
        return view('admin/kullanicilar', compact('users'));
    }
}

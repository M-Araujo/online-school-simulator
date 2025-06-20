<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\User;

class UserController extends Controller
{
 
    public function index(){
       $users = User::all();
        return view('users.index')->with(compact('users'));
    }

}

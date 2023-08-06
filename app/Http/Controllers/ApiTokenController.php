<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ApiTokenController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function admin(){
        return view('api_admin.admin');
    }

    public function manage(){
        $users = User::where('client_id', null)->orderBy('name', 'asc')->paginate(15);
        return view('api_admin.manage', compact('users'));
    }
}

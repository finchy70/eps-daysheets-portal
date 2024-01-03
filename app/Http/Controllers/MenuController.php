<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function menu(){
        $unauthorisedUsers = User::query()->where('authorised', false)->where('leaver', false)->count();

        return view('menu', [
            'unauthorisedUsers' => $unauthorisedUsers
        ]);
    }
}

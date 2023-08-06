<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\User;
use Session;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('authorised', true)
            ->with('client')
            ->orderBy('name', 'asc')
            ->paginate(15);

        return view('users.index', compact('users'));
    }

    public function edit(User $user)
    {
        if ($user->id == 1) {
            return redirect()->action([UserController::class, 'index']);
        }
        else {
            $clients = Client::orderBy('name', 'asc')->get();
            return view('users.edit', compact('user', 'clients'));
        }
    }

    public function update(User $user)
    {
        if($user->email == request('email')){
            request()->validate([
                'clientId' => 'required',
                'name' => 'required',
            ]);
        } else {
            request()->validate([
                'clientId' => 'required',
                'email' => 'required|email|unique:users',
                'name' => 'required',
            ]);
        }

        $user->name = request('name');
        $user->email = request('email');
        if(request('clientId') == '1000')
        {
            $user->client_id = null;
            $user->admin = false;
        } elseif (request('clientId') == '2000')
        {
            $user->client_id = null;
            $user->admin = true;
        } else {
            $user->admin = false;
            $user->client_id = request('clientId');
        }
        $user->update();
        Session::flash('success', 'User updated successfully!');
        return redirect()->action([UserController::class, 'index']);

    }

    public function auth()
    {
        $users = User::select(['id', 'name', 'email', 'authorised', 'admin', 'client_id', 'created_at'])
            ->where('authorised', false)
            ->where('leaver', false)
            ->orderBy('name', 'asc')
            ->paginate(10);

        return view('users.auth_users', [
            'users' => $users
        ]);
    }

    public function un_auth(User $user)
    {
        $user->authorised = false;
        $user->update();
        return redirect()->action([UserController::class, 'index']);
    }

    public function leaver(User $user)
    {
        $user->authorised = false;
        $user->leaver = true;
        $user->update();
        return redirect()->action([UserController::class, 'index']);
    }

    public function delete(User $user)
    {
        $user->delete();
        return redirect()->action([UserController::class, 'index']);
    }
}

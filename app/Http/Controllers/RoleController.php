<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleFormRequest;
use App\Models\Client;
use App\Models\Rate;
use App\Models\Role;
use Illuminate\Http\Request;
use Session;

class RoleController extends Controller
{
    public function index() {
        return view('roles.index',[
            'roles' => Role::query()->orderBy('role')->get()
            ]);
    }

    public function create() {
        return view('roles.create');
    }

    public function store(RoleFormRequest $request) {
        $validated = $request->validated();
        $clients = Client::query()->get();
        $role = Role::query()->create([
            'role' => $validated['role'],
        ]);
        foreach($clients as $client) {
            Rate::query()->create([
                'role_id' => $role->id,
                'client_id' => $client->id,
                'valid_from' => now()->format('Y-m-d').' 00:00:00',
                'rate' => $request->rate
            ]);

        }
        Session::flash('success', 'You have successfully created a new role!');
        return redirect()->route('roles');
    }

    public function edit(Role $role){
        return view('roles.edit', [
            'role' => $role
        ]);
    }

    public function update(RoleFormRequest $request, Role $role) {
        $validated = $request->validated();
        $role->update([
            'role' => $validated['role'],
        ]);
        Session::flash('success', 'You have successfully updated a role!');
        return redirect()->route('roles');
    }
}

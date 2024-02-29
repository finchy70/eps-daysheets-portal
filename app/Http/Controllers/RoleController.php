<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleFormRequest;
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
        Role::query()->create([
            'role' => $validated['role'],
        ]);
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

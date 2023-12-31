<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Update;
use Session;

class ClientController extends Controller
{
    public function index(){
        $clients = Client::orderBy('name', 'asc')->paginate(25);
        return view('clients.index', compact('clients'));
    }

    public function create(){
        return view('clients.create');
    }

    public function store(){
        $data = request()->validate([
            'name' => 'required|unique:clients'
        ]);
        Client::create($data);
        Session::flash('success', 'The Client was successfully added!');

        return redirect()->action([ClientController::class, 'index']);
    }

    public function edit(Client $client){

        return view('clients.edit', compact('client'));
    }

    public function update(Client $client){
        if (request('name') === $client->name) {
            Session::flash('message', 'No changes were made to the name!');
        } else {
            $data = request()->validate([
                'name' => 'required|unique:clients'
            ]);

            $client->name = $data['name'];
            $client->update();
            Update::query()->where('id', 1)->update(['data_updated' => now()]);
            Session::flash('success', 'The Client was successfully updated!');
        }
        return redirect()->action([ClientController::class, 'index']);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Role;
use App\Models\Update;
use http\Client\Request;
use Illuminate\Database\Eloquent\Builder;
use Session;

class ClientController extends Controller
{
    public function index()
    {
        if(auth()->user()->client_id != null) {
            session()->flash('info', 'You are not authorised to perform this action.');
            return redirect()->back();
        } else {
            $clients = Client::orderBy('name', 'asc')->paginate(25);
            return view('clients.index', [
                'clients' => $clients
            ]);
        }
    }

    public function create()
    {
        return view('clients.create');
    }

//    public function store(){
//        $data = request()->validate([
//            'name' => 'required|unique:clients',
//            'markup' => 'required:min:1|max:50'
//        ]);
//        Client::create($data);
//        Session::flash('success', 'The Client was successfully added!');
//
//        return redirect()->action([ClientController::class, 'index']);
//    }

    public function edit(Client $client){
        $rates = $client->currentRates()->orderBy('rate', 'desc')
            ->with('role')
            ->get();
        return view('clients.edit', compact('client', 'rates'));
    }

    public function update(Client $client) {
        $data = request()->validate([
            'name' => 'required|unique:clients,name,'.$client->id,
        ]);
        $client->name = $data['name'];

        $client->update();
        Update::query()->where('id', 1)->update(['data_updated' => now()]);
        Session::flash('success', 'The Client was successfully updated!');
        return redirect()->action([ClientController::class, 'index']);
    }
}

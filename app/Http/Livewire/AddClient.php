<?php

namespace App\Http\Livewire;

use App\Http\Controllers\ClientController;
use App\Models\Client;
use App\Models\Update;
use Livewire\Component;
use Session;

class AddClient extends Component
{
    public string $name = "";

    public function create()
    {
        $data = $this->validate([
            'name' => 'required|unique:clients'
        ]);
        $client = new Client;
        $client->name = $data['name'];
        $client->save();
        $update = Update::find(1);
        $update->data_updated = now();
        $update->update();
        Session::flash('success', 'The Client was successfully added!');

        return redirect()->action([ClientController::class, 'index']);
    }

    public function render()
    {
        return view('livewire.add-client');
    }
}

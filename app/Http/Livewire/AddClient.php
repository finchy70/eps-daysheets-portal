<?php

namespace App\Http\Livewire;

use App\Http\Controllers\ClientController;
use App\Models\Client;
use App\Models\Rate;
use App\Models\Role;
use App\Models\Update;
use App\Models\Mileage;
use Illuminate\Http\RedirectResponse;
use Livewire\Component;
use Session;

class AddClient extends Component
{
    public string $name = "";
    public ?float $markup = null;
    public ?float $mileage = null;

    public function create(): mixed
    {
        $data = $this->validate([
            'name' => 'required|unique:clients',
            'markup' => 'required|numeric|min:1|max:50',
            'mileage' => 'required|numeric|min:0,01'
        ]);
        $client = new Client;
        $client->name = $data['name'];
        $client->markup = $data['markup'];
        $client->save();
        $update = Update::find(1);
        $update->data_updated = now();
        $update->update();
        $roles = Role::query()->get();
        foreach($roles as $role){
            Rate::query()->create([
               'client_id' => $client->id,
               'role_id' => $role->id,
               'valid_from' => now()->subDays(30),
               'rate' => 0.00
            ]);
        }
        Mileage::query()->create([
            'client_id' => $client->id,
            'rate' => $data['mileage'],
            'valid_from' => now()->subDays(30)
        ]);
        Session::flash('success', 'The Client was successfully added!  Please Update the Rates.');
        return redirect()->route('clients.edit', $client->id);
    }

    public function render(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.add-client');
    }
}

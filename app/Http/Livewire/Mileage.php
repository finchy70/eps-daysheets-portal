<?php

namespace App\Http\Livewire;

use App\Models\Client;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Component;

class Mileage extends Component
{
    public function update($id)
    {

    }
    public function render(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $clients = Client::query()->orderBy('name')->with('currentMileageRate')->get();
        return view('livewire.mileage', [
            'clients' => $clients
        ]);
    }
}

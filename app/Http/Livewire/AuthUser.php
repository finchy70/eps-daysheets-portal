<?php

namespace App\Http\Livewire;

use App\Http\Controllers\UserController;
use App\Models\Client;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class AuthUser extends Component
{

    public ?User $user = null;
    public ?Collection $clients = null;
    public ?String $selectedClient = null;
    public bool $admin = false;

    public function mount($aUser)
    {
        $this->user = $aUser;
        $this->clients = Client::orderBy('name', 'asc')->get();
    }

    public function authorise(): \Livewire\Redirector
    {

        if($this->selectedClient == "1000")
        {
            $this->user->client_id = null;
            $this->admin = false;
        }
        else if ($this->selectedClient == "2000")
        {
            $this->user->client_id = null;
            $this->user->admin = true;
        }
        else
        {
            $this->user->client_id = $this->selectedClient;
        }
        $this->user->authorised = true;
        $this->user->update();
        return redirect()->action([UserController::class, 'auth']);
    }
    public function render()
    {
        return view('livewire.auth-user');
    }
}

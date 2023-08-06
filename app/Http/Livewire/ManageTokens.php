<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class ManageTokens extends Component
{
    use WithPagination;

    public function revokeToken($id)
    {
        $selected_user = User::find($id);
        $selected_user->tokens()->delete();
    }

    public function render()
    {
        return view('livewire.manage-tokens', [
            'users' => User::where('client_id', null)->with('tokens')
                ->orderBy('name', 'asc')->paginate(15),
        ]);
    }
}

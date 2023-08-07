<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Component;
use Livewire\WithPagination;

class ManageTokens extends Component
{
    use WithPagination;

    public function revokeToken($id): void
    {
        $selected_user = User::find($id);
        $selected_user->tokens()->delete();
    }

    public function render(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.manage-tokens', [
            'users' => User::where('client_id', null)->with('tokens')
                ->orderBy('name', 'asc')->paginate(15),
        ]);
    }
}

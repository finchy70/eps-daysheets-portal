<?php

namespace App\Http\Livewire\Daysheet;

use App\Models\Client;
use App\Models\Daysheet;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Application;
use JetBrains\PhpStorm\NoReturn;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    public string $searchedJobNumber = '';
    public string $selectedClient = '';
    use WithPagination;

    #[NoReturn] public function editDaysheet($id):void {
        dd($id);
    }

    public function getData() {
        return Daysheet::query()->orderBy('work_date', 'desc')->with('client')
            ->when($this->searchedJobNumber != '', function ($q) {
                return $q->where('job_number', $this->searchedJobNumber);
            })
            ->when($this->selectedClient != "", function ($q) {
                return $q->where('client_id', $this->selectedClient);
            })
            ->paginate(15);
    }

    public function render(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $clientList = Client::query()->orderBy('name', 'asc')->get();
        return view('livewire.daysheet.index', [
            'daysheets' => $this->getData(),
            'clientList' => $clientList
        ]);
    }
}

<?php /** @noinspection PhpIncompatibleReturnTypeInspection */

namespace App\Http\Livewire\Daysheet;

use App\Models\Client;
use App\Models\Daysheet;
use Carbon\Carbon;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use JetBrains\PhpStorm\NoReturn;
use LaravelIdea\Helper\App\Models\_IH_Daysheet_C;
use Livewire\Component;
use Livewire\Redirector;
use Livewire\WithPagination;

class Index extends Component
{
    public string $searchedJobNumber = '';
    public string $searchedSite = '';
    public string $searchedWorkDate = '';
    public string $selectedClient = '';
    use WithPagination;
    protected $listeners = ['toggled'];

    public function toggled($daysheetId):void {
        $this->getData();
    }

    public function getData(): LengthAwarePaginator|\Illuminate\Pagination\LengthAwarePaginator|_IH_Daysheet_C|array
    {
        return Daysheet::query()->orderBy('work_date', 'desc')->with(['client', 'materials'])
            ->when(auth()->user()->client_id != null, function ($q) {
                return $q->where('client_id', auth()->user()->client_id)->where('published', true);
            })
            ->when($this->searchedJobNumber != '', function ($q) {
                return $q->where('job_number', $this->searchedJobNumber);
            })
            ->when($this->selectedClient != "", function ($q) {
                return $q->where('client_id', $this->selectedClient);
            })
            ->when($this->searchedSite != '', function ($q) {
                return $q->where('site_name', 'like', '%'.$this->searchedSite.'%');
            })
            ->when($this->searchedWorkDate != '', function ($q) {
                return $q->where('work_date', '=' , Carbon::parse($this->searchedWorkDate)->format('Y-m-d'));
            })
            ->paginate(15);
    }

    public function newDaysheet(): Redirector
    {
        return redirect()->route('daysheet.create');
    }

    public function authoriseDaysheet($id): void
    {
        $daysheet = Daysheet::query()->where('id', $id)->first();
        $daysheet->update([
            'client_confirmed' => true
        ]);
        $this->getData();
    }

    public function render(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        if(auth()->user()->client_id == null){
            $clientList = Client::query()->orderBy('name', 'asc')->get();
        } else {
            $clientList = Client::query()->where('id', auth()->user()->client_id)->get();
        }

        return view('livewire.daysheet.index', [
            'daysheets' => $this->getData(),
            'clientList' => $clientList
        ])->layout('layouts.app');
    }
}

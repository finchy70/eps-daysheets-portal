<?php

namespace App\Http\Livewire\Daysheet;

use App\Models\Daysheet;
use App\Models\Hotel;
use JetBrains\PhpStorm\NoReturn;
use Livewire\Component;
use Session;

class Hotels extends Component
{
    public Daysheet $daysheet;
    public float $total = 0.00;
    public bool $showNewHotels = false;
    public bool $showEditHotels = false;
    public bool $showDeleteModal = false;
    public string $name = '';
    public int $quantity = 0;
    public float $costPerUnit = 0.00;
    public string $formattedGrandTotal = '0.00';

    #[NoReturn] public function mount($daysheetId): void {
        $this->daysheet = Daysheet::find($daysheetId);
        $this->getHotels();
    }

    public function newAccommodation() : void {
        $this->showNewHotels = true;
        $this->clearForm();
    }

    public function updated($key):void {
        switch($key) {
            case 'quantity':
            case 'costPerUnit':
                $this->formattedGrandTotal = '£ '.number_format(($this->quantity * $this->costPerUnit), 2, thousands_separator: '');
                break;
        }
    }

    public function getHotels(): void
    {
        $this->total = 0;
        $this->daysheet->load('hotels');
        foreach($this->daysheet->hotels as $hotel) {
            $this->total += ($hotel->quantity * $hotel->cost_per_unit);
        }
    }

    public function submit(): void
    {
        $data = $this->validate([
            'name' => 'required',
            'quantity' => 'required|min:1',
            'costPerUnit' => 'required|min:0.01'
        ]);
        Hotel::query()->create([
            'daysheet_id' => $this->daysheet->id,
            'name' => $data['name'],
            'quantity' => $data['quantity'],
            'cost_per_unit' => $data['costPerUnit']
        ]);
        $this->showNewHotels = false;
        $this->dispatchBrowserEvent('notify-success', 'You successfully added accommodation.');
        Session::flash('success', 'You successfully added accommodation.');
        $this->getHotels();
    }

    public function clearForm():void {
        $this->hotel = '';
        $this->quantity = 0;
        $this->costPerUnit = 0;
        $this->formattedGrandTotal = '0.00';
    }

    public function render()
    {
        return view('livewire.daysheet.hotels');
    }
}

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
    public ?int $deleteId = null;
    public string $name = '';
    public ?int $quantity = null;
    public ?float $costPerUnit = null;
    public string $formattedGrandTotal = '0.00';

    public ?Hotel $editHotel;
    public ?string $editName = null;
    public ?string $editQuantity = null;
    public ?string $editCostPerUnit = null;
    public ?string $editFormattedGrandTotal = null;


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
            case 'editQuantity':
            case 'editCostPerUnit':
                if(isset($this->editQuantity) && isset($this->editCostPerUnit)){
                    $this->editFormattedGrandTotal = '£ '. number_format(floatval($this->editQuantity) * floatval($this->editCostPerUnit), 2, thousands_separator: ',');
                }
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

    public function submitEdit(): void{
        $this->validate([
           'editName' => 'required',
           'editQuantity' => 'required|numeric',
           'editCostPerUnit' =>'required|numeric'
        ]);

        $this->editHotel->update([
            'name' => $this->editName,
            'quantity' => $this->editQuantity,
            'cost_per_unit' => $this->editCostPerUnit
        ]);
        $this->showEditHotels = false;
        $this->getHotels();
        $this->dispatchBrowserEvent('notify-success', 'You have successfully updated an item.');

    }

    public function clearForm():void {
        $this->name = '';
        $this->quantity = null;
        $this->costPerUnit = null;
        $this->formattedGrandTotal = '0.00';
    }

    public function editHotel($id): void
    {
        $this->editHotel = Hotel::query()->where('id', $id)->first();
        $this->editName = $this->editHotel->name;
        $this->editQuantity = $this->editHotel->quantity;
        $this->editCostPerUnit = $this->editHotel->cost_per_unit;
        $this->editFormattedGrandTotal = '£ '. number_format($this->editQuantity * $this->editCostPerUnit, 2, thousands_separator: ',');
        $this->showEditHotels = true;
    }

    public function delete($id): void
    {
        $this->showDeleteModal = true;
        $this->deleteId = $id;
    }

    public function confirmDelete(): void
    {
        Hotel::query()->where('id', $this->deleteId)->first()->delete();
        $this->getHotels();
        $this->showDeleteModal = false;
        $this->dispatchBrowserEvent('notify-success', 'You have successfully deleted an item.');

    }

    public function render()
    {
        return view('livewire.daysheet.hotels');
    }
}

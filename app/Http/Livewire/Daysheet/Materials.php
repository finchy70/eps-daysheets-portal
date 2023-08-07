<?php

namespace App\Http\Livewire\Daysheet;

use App\Models\Daysheet;
use App\Models\Material;
use JetBrains\PhpStorm\NoReturn;
use Livewire\Component;
use Session;


class Materials extends Component
{
    public ?Daysheet $daysheet = null;
    public float $total = 0.00;
    public bool $showNewMaterials = false;
    public ?float $quantity = null;
    public ?float $costPerUnit = null;
    public ?string $formattedGrandTotal = '0.00';
    public ?string $materials = null;


    #[NoReturn] public function mount($daysheetId): void {
       $this->daysheet = Daysheet::find($daysheetId);
       $this->getMaterials();
    }

    public function getMaterials() {
        $this->total = 0;
        $this->daysheet->load('materials');
        foreach($this->daysheet->materials as $material) {
            $this->total += ($material->quantity * $material->cost_per_unit);
        }
    }

    public function updated($key):void {
        switch($key) {
            case 'quantity':
            case 'costPerUnit':
                $this->formattedGrandTotal = '£ '.number_format(($this->quantity * $this->costPerUnit), 2, thousands_separator: '');
                break;
        }
    }

    public function delete($id) {
        Material::query()->where('id', $id)->delete();
        $this->dispatchBrowserEvent('notify-success', 'Material successfully deleted');
        Session::flash('success', 'Material successfully deleted.');
        $this->getMaterials();
    }

    public function newMaterials() : void {
        $this->showNewMaterials = true;
        $this->clearForm();
    }

    public function clearForm():void {
        $this->materials = '';
        $this->quantity = null;
        $this->costPerUnit = null;
        $this->formattedGrandTotal = '0.00';
    }

    public function submit() {
        $data = $this->validate([
           'materials' => 'required',
           'quantity' => 'required',
           'costPerUnit' => 'required'
        ]);
        Material::query()->create([
            'daysheet_id' => $this->daysheet->id,
            'name' => $data['materials'],
            'quantity' => $data['quantity'],
            'cost_per_unit' => $data['costPerUnit']
        ]);
        $this->showNewMaterials = false;
        $this->dispatchBrowserEvent('notify-success', 'You successfully added materials');
        Session::flash('success', 'You successfully added materials');
        $this->getMaterials();
    }

    public function render()
    {
        return view('livewire.daysheet.materials');
    }
}

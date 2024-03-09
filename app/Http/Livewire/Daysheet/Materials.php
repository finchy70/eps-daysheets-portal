<?php

namespace App\Http\Livewire\Daysheet;

use App\Models\Daysheet;
use App\Models\Engineer;
use App\Models\Material;
use App\Models\Role;
use Carbon\Carbon;
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
    public ?Material $editMaterial = null;
    public ?float $editQuantity = null;
    public ?float $editCostPerUnit = null;
    public ?string $editFormattedGrandTotal = '0.00';
    public ?string $editMaterials = null;
    public ?int $idToDelete = null;
    public bool $showDeleteModal = false;
    public bool $showEditMaterials = false;


    #[NoReturn] public function mount($daysheetId): void {
       $this->daysheet = Daysheet::find($daysheetId);
       $this->getMaterials();
    }

    public function getMaterials(): void
    {
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

    public function newMaterials() : void {
        $this->showNewMaterials = true;
        $this->clearForm();
    }

    public function editMaterial($id): void
    {
        $this->resetErrorBag();
        $this->editMaterial = Material::query()->where('id', $id)->first();
        $this->editQuantity = $this->editMaterial->quantity;
        $this->editMaterials = $this->editMaterial->name;
        $this->editCostPerUnit = $this->editMaterial->cost_per_unit;
        $this->formattedGrandTotal = '£ '.number_format($this->editQuantity * $this->editCostPerUnit, 2, thousands_separator: ',');
        $this->showEditMaterials = true;

    }

    public function edit() {
        $this->validate([
            'editMaterial' => 'required',
            'editCostPerUnit' => 'required',
            'editQuantity' => 'required'
        ]);
        $this->editMaterial->update([
            'name' => $this->editMaterials,
            'quantity' => $this->editQuantity,
            'cost_per_unit' => $this->editCostPerUnit
        ]);
        $this->showEditMaterials = false;
        $this->getMaterials();
        $this->dispatchBrowserEvent('notify-success', 'You have successfully updated a Material.');
    }

    public function updatedEditQuantity(): void {
        $this->formattedGrandTotal = '£ '.number_format($this->editQuantity * $this->editCostPerUnit, 2, thousands_separator: ',');
    }

    public function updatedEditCostPerUnit(): void {
        $this->formattedGrandTotal = '£ '.number_format($this->editQuantity * $this->editCostPerUnit, 2, thousands_separator: ',');

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

    public function delete($id): void
    {
        $this->idToDelete = $id;
        $this->showDeleteModal = true;
    }

    public function confirmedDelete(): void
    {
        Material::query()->where('id', $this->idToDelete)->delete();
        $this->dispatchBrowserEvent('notify-success', 'Engineer successfully deleted.');
        $this->getMaterials();
        $this->showDeleteModal = false;
    }

    public function render()
    {
        return view('livewire.daysheet.materials');
    }
}

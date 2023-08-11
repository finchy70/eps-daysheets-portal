<?php

namespace App\Http\Livewire\Daysheet;

use App\Models\Daysheet;
use App\Models\Engineer;
use App\Models\Role;
use Carbon\Carbon;
use Livewire\Component;

class Engineers extends Component
{
    public ?String $name = null;
    public ?float $hoursAsFraction = null;
    public ?String $hours = null;
    public ?String $role = null;
    public ?float $total = null;
    public ?String $editName = null;
    public mixed $editRole = null;
    public ?String $editRate = null;
    public ?String $editFormattedRate = null;
    public ?float $editHoursAsFraction = null;
    public ?String $editHours = null;
    public ?int $selectedRole = null;
    public ?String $editTotal = null;
    public mixed $Engineers = null;
    public ?Engineer $editEngineer = null;
    public ?Daysheet $daysheet = null;
    public bool $showNewEngineers = false;
    public mixed $roles = null;

    public function mount($daysheetId) {
        $this->daysheet = Daysheet::find($daysheetId);
        $this->getEngineers();
        $this->roles = Role::query()->orderBy('role')->get();
    }

    public function getEngineers() {
        $this->total = 0;
        $this->daysheet->load('engineers');
        foreach($this->daysheet->engineers as $engineer) {
            $this->total += ($engineer->rate * $engineer->hours_as_fraction);
        }
    }

    public function updatedSelectedRole($id) {
        $this->editRole = Role::query()->where('id', $id)->first();
        $this->editRate = $this->editRole->rate;
        $this->editFormattedRate = '£ '.number_format($this->editRole->rate, 2, thousands_separator: ',');
        $this->editTotal = '£ '.number_format($this->editHoursAsFraction * floatval($this->editRole->rate), 2, thousands_separator: ',');
    }

    public function updatedEditHours($time) {

        $this->getHoursAsFraction($time);
        $this->editTotal = '£ '.number_format($this->editHoursAsFraction * floatval($this->editRole->rate), 2, thousands_separator: ',');
    }

    public function getHoursAsFraction($time)
    {
        $hours = intval(Carbon::parse($time)->format('H'));
        $minutes = intval(Carbon::parse($time)->format('i'));
        $fraction = $minutes / 60;

        $nearestQuarter = floor($fraction * 4) / 4;
        $this->editHoursAsFraction = $hours + $nearestQuarter;
    }

    public function editEngineer($id) {
        $this->resetErrorBag();
        $this->editEngineer = Engineer::query()->where('id', $id)->first();
        $this->editRole = Role::query()->where('role', $this->editEngineer->role)->orderBy('id', 'desc')->first();
        $this->selectedRole = $this->editRole->id;
        $this->showNewEngineers = true;
        $this->editName = $this->editEngineer->name;
        $this->editHoursAsFraction = $this->editEngineer->hours_as_fraction;
        $this->editHours = Carbon::parse($this->editEngineer->hours)->format('H:i');
        $this->editRate = $this->editEngineer->rate;
        $this->editFormattedRate = '£ '.number_format($this->editEngineer->rate, 2, thousands_separator: ',');
        $this->editTotal = '£ '.number_format($this->editEngineer->hours_as_fraction * floatval($this->editEngineer->rate), 2, thousands_separator: ',');
    }

    public function update() {
        $this->validate([
            'editName' => 'required',
            'editHours' => 'required',
        ],
        [
            'editHours' => 'The hours field is required.'
        ]
        );
        $this->editEngineer->name = $this->editName;
        $this->editEngineer->hours = $this->editHours;
        $this->editEngineer->role = Role::query()->where('id', $this->selectedRole)->first()->role;
        $this->editEngineer->hours_as_fraction = $this->editHoursAsFraction;
        $this->editEngineer->rate = $this->editRate;
        $this->editEngineer->update();
        $this->showNewEngineers = false;
        $this->getEngineers();
        $this->dispatchBrowserEvent('notify-success', 'You have successfully updated an Engineer.');
    }


    public function render()
    {
        return view('livewire.daysheet.engineers');
    }
}

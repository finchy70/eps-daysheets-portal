<?php

namespace App\Http\Livewire\Daysheet;

use App\Models\Daysheet;
use App\Models\Engineer;
use App\Models\Material;
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
    public ?String $newTotal = null;
    public ?float $newRate = null;
    public ?String $newFormattedRate = null;
    public ?int $newSelectedRole = null;
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
    public bool $showNewEngineer = false;
    public bool $showEditEngineer = false;
    public bool $showDeleteModal = false;
    public mixed $roles = null;
    public ?int $idToDelete = null;

    public function mount($daysheetId): void
    {
        $this->daysheet = Daysheet::find($daysheetId);
        $this->getEngineers();
        $this->roles = Role::query()->orderBy('role')->get();
    }

    public function getEngineers(): void
    {
        $this->total = 0;
        $this->daysheet->load('engineers');
        foreach($this->daysheet->engineers as $engineer) {
            $this->total += ($engineer->rate * $engineer->hours_as_fraction);
        }
    }

    public function updatedSelectedRole($id): void
    {
        $this->editRole = Role::query()->where('id', $id)->first();
        $this->editRate = $this->editRole->rate;
        $this->editFormattedRate = '£ '.number_format($this->editRole->rate, 2, thousands_separator: ',');
        $this->editTotal = '£ '.number_format($this->editHoursAsFraction * floatval($this->editRate), 2, thousands_separator: ',');
    }

    public function updatedEditHours($time): void
    {
        $this->editHoursAsFraction = $this->getHoursAsFraction($time);
        $this->editHours = $time;
        $this->editTotal = '£ '.number_format($this->editHoursAsFraction * floatval($this->editRate), 2, thousands_separator: ',');
    }

    public function getHoursAsFraction($time): float|int
    {
        $hours = intval(Carbon::parse($time)->format('H'));
        $minutes = intval(Carbon::parse($time)->format('i'));
        $fraction = $minutes / 60;

        $nearestQuarter = floor($fraction * 4) / 4;
        return $hours + $nearestQuarter;
    }

    public function editEngineer($id): void
    {
        $this->resetErrorBag();
        $this->editEngineer = Engineer::query()->where('id', $id)->first();
        $this->editRole = Role::query()->where('role', $this->editEngineer->role)->orderBy('id', 'desc')->first();
        $this->selectedRole = $this->editRole->id;
        $this->showEditEngineer = true;
        $this->editName = $this->editEngineer->name;
        $this->editHoursAsFraction = $this->editEngineer->hours_as_fraction;
        $this->editHours = Carbon::parse($this->editEngineer->hours)->format('H:i');
        $this->editRate = $this->editEngineer->rate;
        $this->editFormattedRate = '£ '.number_format($this->editEngineer->rate, 2, thousands_separator: ',');
        $this->editTotal = '£ '.number_format($this->editEngineer->hours_as_fraction * floatval($this->editEngineer->rate), 2, thousands_separator: ',');
    }

    public function update(): void
    {
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
        $this->showEditEngineer = false;
        $this->getEngineers();
        $this->dispatchBrowserEvent('notify-success', 'You have successfully updated an Engineer.');
    }

    public function newEngineer(): void
    {
        $role = Role::query()->orderBy('role', 'asc')->first();
        $this->newSelectedRole = $role->id;
        $this->name = '';
        $this->hours = '';
        $this->showNewEngineer = true;
        $this->newRate = $role->rate;
        $this->newFormattedRate = '£ '.number_format($this->newRate, 2, thousands_separator: ',');
    }

    public function updatedHours($time) {
        $this->hoursAsFraction = $this->getHoursAsFraction($time);

        $this->newTotal = '£ '.number_format($this->hoursAsFraction * floatval($this->newRate), 2, thousands_separator: ',');

    }

    public function updatedNewSelectedRole($id): void
    {
        $role = Role::query()->where('id', $id)->first();
        $this->newRate = $role->rate;
        $this->newFormattedRate = '£ '.number_format($this->newRate, 2, thousands_separator: ',');
        $this->newTotal = '£ '.number_format($this->hoursAsFraction * floatval($this->newRate), 2, thousands_separator: ',');
    }

    public function create() {
        $this->validate([
            'name' => 'required',
            'hours' => 'required',
            ],
            [
                'hours' => 'The hours field is required.'
            ]
        );
        Engineer::query()->create([
            'name' => $this->name,
            'daysheet_id' => $this->daysheet->id,
            'role' => Role::query()->where('id', $this->newSelectedRole)->first()->role,
            'rate' => $this->newRate,
            'hours' => $this->hours,
            'hours_as_fraction' => $this->hoursAsFraction
        ]);
        $this->showNewEngineer = false;
        $this->getEngineers();
        $this->dispatchBrowserEvent('notify-success', 'You have successfully added a new Engineer.');
    }

    public function delete($id) {
        $this->idToDelete = $id;
        $this->showDeleteModal = true;
    }

    public function confirmedDelete() {
        Engineer::query()->where('id', $this->idToDelete)->delete();
        $this->dispatchBrowserEvent('notify-success', 'Engineer successfully deleted.');
        $this->getEngineers();
        $this->showDeleteModal = false;
    }

    public function render()
    {
        return view('livewire.daysheet.engineers');
    }
}

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
    public ?String $minutes = '00';
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
    public ?String $editMinutes = null;
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
        $this->editRate = $this->editRole->getRateByDate($this->daysheet->start_date, $id, $this->daysheet->client_id)->first()->rate;
        $this->editFormattedRate = '£ '.number_format($this->editRate, 2, thousands_separator: ',');
        $this->editTotal = '£ '.number_format($this->editHoursAsFraction * floatval($this->editRate), 2, thousands_separator: ',');
    }

    public function updatedEditHours():void
    {
        $this->updateEditTotal();
    }

    public function updatedEditMinutes():void
    {
        $this->updateEditTotal();
    }

//    public function updatedHours():void
//    {
//        $this->updateNewTotal();
//    }
//
//    public function updatedMinutes():void
//    {
//        $this->updateNewTotal();
//    }

    public function updateEditTotal(): void
    {
        $this->editHoursAsFraction = $this->getHoursAsFraction('edit');
        $this->editTotal = '£ '.number_format($this->editHoursAsFraction * floatval($this->editRate), 2, thousands_separator: ',');
    }

    public function updateNewTotal(): void
    {
        $this->hoursAsFraction = $this->getHoursAsFraction('new');
        $this->total = $this->editHoursAsFraction * floatval($this->editRate);
    }

    public function getHoursAsFraction($type = 'new'): float|int
    {
        if($type == 'new'){
            $hours = $this->hours;
            $minutes = $this->minutes;
        } else{
            $hours = $this->editHours;
            $minutes = $this->editMinutes;
        }
        $fraction = floatval($minutes) / 60;
        return floatval($hours) + $fraction;
    }

    public function editEngineer($id): void
    {
        $this->resetErrorBag();
        $this->editEngineer = Engineer::query()->where('id', $id)->first();
        $this->editRole = Role::query()->where('id', $this->editEngineer->role_id)->orderBy('id', 'desc')->first();
        $this->selectedRole = $this->editRole->id;
        $this->showEditEngineer = true;
        $this->editName = $this->editEngineer->name;
        $this->editHoursAsFraction = $this->editEngineer->hours_as_fraction;
        $this->editHours = floor($this->editEngineer->hours_as_fraction);
        $spareFraction = $this->editEngineer->hours_as_fraction - $this->editHours;
        $this->editMinutes = number_format($spareFraction * 60, 0, thousands_separator: '');
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
        $this->editEngineer->hours = $this->editHours.':'.$this->editMinutes;
        $this->editEngineer->role_id = $this->selectedRole;
        $this->editEngineer->hours_as_fraction = $this->editHoursAsFraction;
        $this->editEngineer->rate = $this->editRate;
        $this->editEngineer->update();
        $this->showEditEngineer = false;
        $this->getEngineers();
        $this->dispatchBrowserEvent('notify-success', 'You have successfully updated an Engineer.');
    }

    public function newEngineer(): void
    {
        $this->name = '';
        $this->hours = '00';
        $this->minutes = '00';
        $this->showNewEngineer = true;
        $this->newFormattedRate = '£ '.number_format($this->newRate, 2, thousands_separator: ',');
    }

    public function updatedHours():void {
        $this->hoursAsFraction = $this->getHoursAsFraction('new');
        $this->newTotal = '£ '.number_format($this->hoursAsFraction * floatval($this->newRate), 2, thousands_separator: ',');
    }

    public function updatedMinutes():void {
        $this->hoursAsFraction = $this->getHoursAsFraction('new');
        $this->newTotal = '£ '.number_format($this->hoursAsFraction * floatval($this->newRate), 2, thousands_separator: ',');
    }

    public function updatedNewSelectedRole($id): void
    {
        $role = Role::query()->where('id', $id)->first();
        $this->newRate = $role->getRateByDate($this->daysheet->start_date, $role->id, $this->daysheet->client_id)->first()->rate;
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
            'role_id' => Role::query()->where('id', $this->newSelectedRole)->first()->id,
            'rate' => $this->newRate,
            'hours' => $this->hours.":".$this->minutes.":00",
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

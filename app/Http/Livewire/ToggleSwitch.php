<?php

namespace App\Http\Livewire;

use App\Models\Daysheet;
use Livewire\Component;

class ToggleSwitch extends Component
{
    public ?Daysheet $daysheet;
    public $published;

    public function mount(int $daysheetId):void {

        $this->daysheet = Daysheet::where('id', $daysheetId)->first();
        $this->published = $this->daysheet->published == 1;
    }

    public function togglePublished():void {
        $this->daysheet->published = !$this->daysheet->published;
        $this->emitUp('toggled', $this->daysheet->id);
    }

    public function render()
    {
        return view('livewire.toggle-switch');
    }
}

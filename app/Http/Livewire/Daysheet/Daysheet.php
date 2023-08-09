<?php

namespace App\Http\Livewire\Daysheet;

use Carbon\Carbon;
use Livewire\Component;
use app\Models\Daysheet as DaysheetModel;

class Daysheet extends Component
{
    public DaysheetModel $daysheet;
    public string $hours = "";
    public float $rate = 25.50;
    public float $rateTotal = 0.00;
    public float $vat = 0.00;
    public float $rateIncVat = 0.00;
    public float $hoursFraction = 0.00;
    public float $materialTotal = 0.00;

    public function mount(DaysheetModel $daysheet): void
    {
        $this->daysheet = $daysheet->load(['materials', 'client', 'user']);
        $mins = Carbon::parse($this->daysheet->finish_time)->diffInMinutes(Carbon::parse($this->daysheet->start_time));
        $hours = floor($mins/60);
        $spareMinutes = $mins - ($hours * 60);
        $fraction = $spareMinutes/60;

        $nearestQuater = floor($fraction*4) / 4;
        $this->hoursFraction = $hours+$nearestQuater;
        $minutes = strval($spareMinutes);
        if(strlen($minutes) == 0) {
            $minutes = "00";
        }
        elseif(strlen($minutes) < 2) {
            $minutes = "0".$minutes;
        }
        $this->hours = strval($hours).":".strval($minutes);

        $this->rateTotal = number_format(($hours + $fraction) * $this->rate, 2);
        $this->vat = (intval($this->rateTotal) / 100) *20;
        $this->rateIncVat = $this->rateTotal + $this->vat;
        $this->materialTotal = 0;
        foreach($this->daysheet->materials as $material){
            $this->materialTotal += $material->quantity * $material->cost_per_unit;
        }

    }

    public function render()
    {

        return view('livewire.daysheet.daysheet', [
            'daysheet' => $this->daysheet,
            'hours' => $this->hours,
            'rate' => $this->rate,
            'rateTotal' => $this->rateTotal,
            'rateIncVat' => $this->rateIncVat,
            'hoursFraction' => $this->hoursFraction,
            'materialTotal' => $this->materialTotal
        ]);
    }
}

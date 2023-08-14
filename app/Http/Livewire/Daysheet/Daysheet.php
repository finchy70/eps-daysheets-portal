<?php

namespace App\Http\Livewire\Daysheet;

use App\Models\Section;
use App\Traits\HoursCalculator;
use Barryvdh\Snappy\Facades\SnappyPdf as PDF;
use Carbon\Carbon;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Response;
use Livewire\Component;
use app\Models\Daysheet as DaysheetModel;
use Session;

class Daysheet extends Component
{
    public DaysheetModel $daysheet;
    public string $hours = "";
    public string $fraction = "";
    public float $rate = 25.50;
    public float $rateTotal = 0.00;
    public float $vat = 0.00;
    public float $rateIncVat = 0.00;
    public float $hoursFraction = 0.00;
    public float $materialTotal = 0.00;
    public float $engineerTotal = 0.00;

    use HoursCalculator;

    public function mount(DaysheetModel $daysheet): void
    {
        $this->daysheet = $daysheet->load(['materials', 'client', 'user', 'engineers.role']);
        $hoursWorkedArray = $this->getHours($this->daysheet->start_time, $this->daysheet->finish_time);
        $this->hours = $hoursWorkedArray['time'];
        $this->fraction = $hoursWorkedArray['hoursFraction'];
        $this->rateTotal = number_format(floatval($this->fraction) * $this->rate, 2);
        $this->vat = (floatval($this->rateTotal) / 100) *20;
        $this->rateIncVat = $this->rateTotal + $this->vat;
        $this->materialTotal = 0;
        foreach($this->daysheet->materials as $material){
            $this->materialTotal += $material->quantity * $material->cost_per_unit;
        }
        $this->engineerTotal = 0;
        foreach($this->daysheet->engineers as $engineer) {
            $this->engineerTotal += $engineer->hours_as_fraction * $engineer->rate;
        }
    }

    public function confirmDaysheet($id) {
        $this->daysheet->update([
            'client_confirmed' => true
        ]);
        $this->dispatchBrowserEvent('notify-success', 'You have confirmed this daysheet.');
    }

    public function downloadPDF(): Response
    {
        $view = \Illuminate\Support\Facades\View::make('pdfs.daysheet', [
            'daysheet' => $this->daysheet->load(['engineers', 'materials'])
        ]);
        $doc = Pdf::loadHtml($view)->setOption("enable-local-file-access", true)->setPaper('a4')->setOrientation('portrait');
        return $doc->download($this->daysheet->job_number.'-'.$this->daysheet->site_name.'-'.$this->daysheet->client->name . '-daysheet.pdf');
    }



    public function render(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {

        return view('livewire.daysheet.daysheet', [
            'daysheet' => $this->daysheet,
            'hours' => $this->hours,
            'rate' => $this->rate,
            'rateTotal' => $this->rateTotal,
            'rateIncVat' => $this->rateIncVat,
            'hoursFraction' => $this->hoursFraction,
            'materialTotal' => $this->materialTotal,
            'engineerTotal' => $this->engineerTotal,
        ]);
    }
}

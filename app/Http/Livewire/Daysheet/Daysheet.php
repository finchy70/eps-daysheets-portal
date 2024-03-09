<?php

namespace App\Http\Livewire\Daysheet;

use App\Models\Mileage;
use App\Traits\HoursCalculator;
use Barryvdh\Snappy\Facades\SnappyPdf as PDF;
use Carbon\Carbon;
use Illuminate\Contracts\View\Factory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Application;
use Illuminate\Http\Response;
use Livewire\Component;
use app\Models\Daysheet as DaysheetModel;

class Daysheet extends Component
{
    public DaysheetModel $daysheet;
    public string $hours = "";
    public string $fraction = "";
    public float $rate = 0.00;
    public float $rateTotal = 0.00;
    public float $vat = 0.00;
    public float $rateIncVat = 0.00;
    public float $hoursFraction = 0.00;
    public float $materialTotal = 0.00;
    public float $hotelTotal = 0.00;
    public float $engineerTotal = 0.00;
    public float $mileageRate = 0.00;
    public float $markupRate = 0.00;

    use HoursCalculator;

    public function mount(DaysheetModel $daysheet): void
    {
        $this->daysheet = $daysheet->load(['materials', 'client', 'user', 'engineers.role', 'hotels']);
        $hoursWorkedArray = $this->getHours($this->daysheet->start_date, $this->daysheet->start_time, $this->daysheet->finish_date, $this->daysheet->finish_time);
        $this->hours = $hoursWorkedArray['time'];
        $this->fraction = $hoursWorkedArray['hoursFraction'];
        $this->rateTotal = floatval($this->fraction) * $this->rate;
        $this->vat = (floatval($this->rateTotal) / 100) *20;
        $this->rateIncVat = $this->rateTotal + $this->vat;
        $this->materialTotal = 0;
        foreach($this->daysheet->materials as $material){
            $this->materialTotal += $material->quantity * ($material->cost_per_unit * (1 + ($daysheet->markup_rate / 100)));
        }
        $this->mileageRate = $daysheet->mileage_rate;
        $this->markupRate = $daysheet->markup_rate;
        $this->engineerTotal = 0;
        foreach($this->daysheet->engineers as $engineer) {
            $this->engineerTotal += $engineer->hours_as_fraction * $engineer->rate;
        }
        foreach($this->daysheet->hotels as $hotel) {
            $this->hotelTotal += $hotel->quantity * ($hotel->cost_per_unit)* (1 + ($daysheet->markup_rate / 100));
        }
    }

    public function confirmDaysheet($id): void
    {
        $this->daysheet->update([
            'client_confirmed' => true
        ]);
        $this->dispatchBrowserEvent('notify-success', 'You have confirmed this daysheet.');
    }


//    public function downloadPDF(): Response
//    {
//        dd('Here');
//        $doc = Pdf::loadView('pdfs.daysheet', ['daysheet' => $this->daysheet->load(['engineers', 'materials'])])->setPaper('a4')->setOrientation('portrait');
//        return $doc->download($this->daysheet->job_number.'-'.$this->daysheet->site_name.'-'.$this->daysheet->client->name . Carbon::parse($this->daysheet->start_date)->format('d-m-Y').'-daysheet.pdf');
//    }z

    public function render(): \Illuminate\Contracts\View\View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {

        return view('livewire.daysheet.daysheet', [
            'daysheet' => $this->daysheet,
            'hours' => $this->hours,
            'rateTotal' => $this->rateTotal,
            'rateIncVat' => $this->rateIncVat,
            'hoursFraction' => $this->hoursFraction,
            'materialTotal' => $this->materialTotal,
            'engineerTotal' => $this->engineerTotal,
            'hotelTotal' => $this->hotelTotal,
            'mileageRate' => $this->mileageRate,
            'markupRate' => $this->markupRate
            ]);

    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Daysheet;
use App\Models\Mileage;
use Barryvdh\Snappy\Facades\SnappyPdf as PDF;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

class PDFController extends Controller
{
    public function download(Daysheet $daysheet){
        $daysheet = $daysheet->load(['engineers', 'materials']);
        $mileageRate = Mileage::query()->where(function (Builder $q) use ($daysheet) {
            return $q->where('valid_from', '<', $daysheet->start_date)->where('valid_to', '>', $daysheet->finish_date);
        })
            ->orWhere(function (Builder $q) use ($daysheet) {
                return $q->where('valid_from', '<', $daysheet->start_date)->where('valid_to', null);
            })
            ->first()->rate;
        $engineerTotal = 0.00;
        $materialTotal = 0.00;
        $materialTotal += $mileageRate * $daysheet->mileage;
        foreach ($daysheet->engineers as $engineer){
            $engineerTotal += ($engineer->hours_as_fraction * $engineer->rate);
        }
        foreach ($daysheet->materials as $material){
            $materialTotal += ($material->quantity * $material->cost_per_unit);
        }

        $doc = Pdf::loadView('pdfs.daysheet', [
            'mileageRate' => $mileageRate,
            'daysheet' => $daysheet,
            'materialTotal' => $materialTotal,
            'engineerTotal' => $engineerTotal
        ])->setPaper('a4')->setOrientation('portrait');
        return $doc->download($daysheet->job_number.'-'.$daysheet->site_name.'-'.$daysheet->client->name . Carbon::parse($daysheet->start_date)->format('d-m-Y').'daysheet.pdf');
    }
}

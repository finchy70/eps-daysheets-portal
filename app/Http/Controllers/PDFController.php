<?php

namespace App\Http\Controllers;

use App\Models\Daysheet;
use App\Models\Mileage;
use Barryvdh\Snappy\Facades\SnappyPdf as PDF;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

class PDFController extends Controller
{
    public function download(Daysheet $daysheet, String $filename){
        $signatureFilename = decrypt($filename);
        $daysheet = $daysheet->load(['engineers', 'materials']);
        $mileageRate = $daysheet->mileage_rate;
        $mileageTotal = $daysheet->mileage * $daysheet->mileage_rate;
        $engineerTotal = 0.00;
        $materialTotal = 0.00;
        $hotelTotal = 0.00;
        foreach ($daysheet->engineers as $engineer){
            $engineerTotal += ($engineer->hours_as_fraction * $engineer->rate);
        }
        foreach ($daysheet->materials as $material){
            $materialTotal += ($material->quantity * $material->cost_per_unit);
        }
        foreach ($daysheet->hotels as $hotel){
            $hotelTotal += ($hotel->quantity * $hotel->cost_per_unit);
        }

        $doc = Pdf::loadView('pdfs.daysheet', [
            'mileageRate' => $mileageRate,
            'mileageTotal' => $mileageTotal,
            'daysheet' => $daysheet,
            'hotelTotal' => $hotelTotal,
            'materialTotal' => $materialTotal,
            'engineerTotal' => $engineerTotal,
            'signatureFilename' => $signatureFilename
        ])->setPaper('a4')->setOrientation('portrait');
        return $doc->download($daysheet->job_number.'-'.$daysheet->site_name.'-'.$daysheet->client->name . Carbon::parse($daysheet->start_date)->format('d-m-Y').'daysheet.pdf');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Daysheet;
use Barryvdh\Snappy\Facades\SnappyPdf as PDF;

class PDFController extends Controller
{
    public function download(Daysheet $daysheet){
        $daysheet = $daysheet->load(['engineers', 'materials']);

        $engineerTotal = 0.00;
        $materialTotal = 0.00;

        foreach ($daysheet->engineers as $engineer){
            $engineerTotal += ($engineer->hours_as_fraction * $engineer->rate);
        }
        foreach ($daysheet->materials as $material){
            $materialTotal += ($material->quantity * $material->cost_per_unit);
        }



        $doc = Pdf::loadView('pdfs.daysheet', [
            'daysheet' => $daysheet,
            'materialTotal' => $materialTotal,
            'engineerTotal' => $engineerTotal
        ])->setPaper('a4')->setOrientation('portrait');
        return $doc->download($daysheet->job_number.'-'.$daysheet->site_name.'-'.$daysheet->client->name . '-daysheet.pdf');
    }
}

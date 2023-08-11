<?php

namespace App\Http\Controllers;

use App\Http\Requests\DaysheetFormRequest;
use App\Models\Client;
use App\Models\Daysheet;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Session;

class DaysheetController extends Controller
{

    public function edit(Daysheet $daysheet) {
        if(auth()->user()->client != null && auth()->user()->client_id != $daysheet->id) {
            Session::flash('message', 'You can not view daysheets that dont belong to your company!');
            return redirect()->back();
        }
        return view('daysheet.edit', [
            'daysheet' => $daysheet,
            'clients' => Client::query()->orderBy('name')->get()
        ]);
    }

    public function update(DaysheetFormRequest $request, Daysheet $daysheet) {
        $validated = $request->validated();

        $daysheet->update([
            "client_id" => $validated['selectedClient'],
            "site_name" => $validated['site'],
            "job_number" => $validated['jobNumber'],
            "work_date" => Carbon::parse($validated['workDate'])->format('Y-m-d'),
            "start_time" => $validated['startTime'],
            "finish_time" => $validated['finishTime'],
            "issue_fault" => $validated['issueFault'],
            "resolution" => $validated['resolution'],
            "mileage" => $validated['mileage'],
        ]);
        Session::flash('success', 'You have successfully updated a daysheet!');
        return redirect()->route('daysheet.index');

    }

    public function show(Daysheet $daysheet){
        return view('daysheet.daysheet', [
            'daysheet' => $daysheet
        ]);
    }

}

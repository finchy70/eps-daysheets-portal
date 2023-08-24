<?php

namespace App\Http\Controllers;

use App\Http\Requests\DaysheetFormRequest;
use App\Models\Client;
use App\Models\Daysheet;
use App\Models\Engineer;
use App\Models\Role;
use App\Traits\HoursCalculator;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Session;

class DaysheetController extends Controller
{

    use HoursCalculator;
    public function create() {
        if(auth()->user()->client_id == null){
            return view('daysheet.create', [
                'clients' => Client::query()->orderBy('name')->get()
            ]);
        } else {
            Session::flash('message', 'You are not authorised to create daysheets');
            return redirect()->back();
        }

    }

    public function store(DaysheetFormRequest $request) {
        $validated = $request->validated();

        $newDaysheet = Daysheet::query()->create([
            'user_id' => auth()->user()->id,
            "client_id" => $validated['selectedClient'],
            "site_name" => $validated['site'],
            "job_number" => $validated['jobNumber'],
            "work_date" => Carbon::parse($validated['workDate'])->format('Y-m-d'),
            "week_ending" => Carbon::parse($validated['workDate'])->endOfWeek()->format('Y-m-d'),
            "start_time" => $validated['startTime'],
            "finish_time" => $validated['finishTime'],
            "issue_fault" => $validated['issueFault'],
            "resolution" => $validated['resolution'],
            "mileage" => $validated['mileage'],
        ]);

        $hours = $this->getHours($validated['startTime'], $validated['finishTime']);
        Engineer::query()->create([
            'name' => auth()->user()->name,
            'daysheet_id' => $newDaysheet->id,
            'role' => 'SAP',
            'hours' => $hours['time'],
            'hours_as_fraction' => $hours['hoursFraction'],
            'rate' => Role::query()->where('role', 'SAP')->first()->rate
        ]);

        Session::flash('success', 'You have successfully created a daysheet!');
        return redirect()->route('daysheet.index');
    }

    public function edit(Daysheet $daysheet) {
        if(auth()->user()->client != null) {
            Session::flash('message', 'You can not edit daysheets!');
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
            "week_ending" => Carbon::parse($validated['workDate'])->endOfWeek()->format('Y-m-d'),
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
        if($daysheet->client_id == auth()->user()->client_id || auth()->user()->client_id == null){
            return view('daysheet.daysheet', [
                'daysheet' => $daysheet
            ]);
        } else {
            Session::flash('message', 'You can only see daysheets belonging to your company!');
            return redirect(route('daysheet.index'));
        }

    }

}

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
            "week_ending" => Carbon::parse($validated['startDate'])->endOfWeek()->format('Y-m-d'),
            "start_date" => Carbon::parse($validated['startDate'])->format('Y-m-d'),
            "start_time" => $validated['startTime'],
            "finish_date" => Carbon::parse($validated['finishDate'])->format('Y-m-d'),
            "finish_time" => $validated['finishTime'],
            "issue_fault" => $validated['issueFault'],
            "resolution" => $validated['resolution'],
            "mileage" => $validated['mileage'],
        ]);

        $startTime = Carbon::parse($validated['startDate'])->format('d-m-Y').' '.Carbon::parse($validated['startTime'])->format('h:i:s');
        $finishTime = Carbon::parse($validated['finishDate'])->format('d-m-Y').' '.Carbon::parse($validated['finishTime'])->format('h:i:s');
        $totalMinutes = Carbon::parse($startTime)->diffInMinutes(Carbon::parse($finishTime));
        $hours = floor($totalMinutes / 60);
        $minutes = $totalMinutes - ($hours * 60);

        if(strlen($minutes) == 1){
            $formattedMinutes = '0'.$minutes;
        } else {
            $formattedMinutes = $minutes;
        }
        $minutesAsFraction = $minutes/60;
        $hoursAsFraction = $hours + $minutesAsFraction;

        Engineer::query()->create([
            'name' => auth()->user()->name,
            'daysheet_id' => $newDaysheet->id,
            'role' => 'SAP',
            'hours' => $hours.':'.$formattedMinutes,
            'hours_as_fraction' => $hoursAsFraction,
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
            "start_date" => Carbon::parse($validated['startDate'])->format('Y-m-d'),
            "start_time" => $validated['startTime'],
            "finish_date" => Carbon::parse($validated['finishDate'])->format('Y-m-d'),
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

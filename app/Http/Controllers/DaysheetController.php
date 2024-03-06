<?php

namespace App\Http\Controllers;

use App\Http\Requests\DaysheetFormRequest;
use App\Models\Client;
use App\Models\Daysheet;
use App\Models\Engineer;
use App\Models\Role;
use App\Models\User;
use App\Traits\HoursCalculator;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Session;

class DaysheetController extends Controller
{

    use HoursCalculator;
    public function create() {
        $engineers = User::query()->whereNull('client_id')->orderBy('name')->get();
        if(auth()->user()->client_id == null){
            return view('daysheet.create', [
                'engineers' => $engineers,
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
            "start_date" => Carbon::parse($validated['startDate'])->format('Y-m-d'),
            "start_time" => $validated['startTime'],
            "finish_date" => Carbon::parse($validated['finishDate'])->format('Y-m-d'),
            "finish_time" => $validated['finishTime'],
            "issue_fault" => $validated['issueFault'],
            "resolution" => $validated['resolution'],
            "mileage" => $validated['mileage'],
        ]);

        $startTime = Carbon::parse($validated['startDate'])->format('d-m-Y').' '.$validated['startTime'].':00';
        $finishTime = Carbon::parse($validated['finishDate'])->format('d-m-Y').' '.$validated['finishTime'].':00';
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
        $client = Client::query()->where('id', $request->selectedClient)->first();
        Engineer::query()->create([
            'name' => $request->selectedEngineer,
            'daysheet_id' => $newDaysheet->id,
            'role_id' => 1,
            'hours' => $hours.':'.$formattedMinutes,
            'hours_as_fraction' => $hoursAsFraction,
            'rate' => $client->currentRates()->where('role_id', 1)->first()->rate
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

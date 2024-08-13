<?php

namespace App\Http\Controllers;

use App\Http\Requests\DaysheetFormRequest;
use App\Models\Client;
use App\Models\Daysheet;
use App\Models\Engineer;
use App\Models\Markup;
use App\Models\Mileage as MileageRate;
use App\Models\Role;
use App\Models\User;
use App\Traits\HoursCalculator;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Session;

class DaysheetController extends Controller
{

    use HoursCalculator;
    public function create() {
        $engineers = User::query()->whereNull('client_id')->where('authorised', 1)->orderBy('name')->get();
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
        $client = Client::query()->where('id', $validated['selectedClient'])->first();
        $clientMileageRate = MileageRate::query()
            ->where('client_id', $client->id)
            ->where('valid_from', '<=' , Carbon::parse($validated['startDate'])->format('Y-m-d'))
            ->where(function (Builder $q) use ($validated) {
                return $q->where('valid_to', '>', Carbon::parse($validated['startDate'])->format('Y-m-d'))->orWhere('valid_to', null);
            })->first()->rate;
        $currentMarkUpRate = Markup::query()
            ->where('client_id', $client->id)
            ->where('valid_from', '<=' , Carbon::parse($validated['startDate'])->format('Y-m-d'))
            ->where(function (Builder $q) use ($validated) {
                return $q->where('valid_to', '>', Carbon::parse($validated['startDate'])->format('Y-m-d'))->orWhere('valid_to', null);
            })->first()->markup;
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
            "mileage_rate" => floatval($clientMileageRate),
            "markup_rate" => floatval($currentMarkUpRate),
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
            'rate' => $client->rateFromDate($validated['startDate'], $client->id, 1)->first()->rate
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
            if(!$daysheet->published) {
                Session::flash('message', 'You can only view published Daysheets!');
                return redirect(route('daysheet.index'));
            } else {
                return view('daysheet.daysheet', [
                    'daysheet' => $daysheet
                ]);
            }

        } else {
            Session::flash('message', 'You can only see daysheets belonging to your company!');
            return redirect(route('daysheet.index'));
        }

    }

}

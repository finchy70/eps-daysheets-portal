<?php

namespace App\Http\Controllers;

use App\Http\Livewire\Mileage;
use App\Models\Client;
use App\Models\Mileage as MileageRate;
use App\Models\Daysheet;
use App\Models\Device;
use App\Models\Engineer;
use App\Models\Material;
use App\Models\Role;
use App\Models\Update;
use App\Traits\HoursCalculator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class DataController extends Controller
{
    use HoursCalculator;

    public function standingData(Request $request)
    {
        $user = $request->user();
        $token = $user->tokens()->first();
        $updated_last = Update::first();
        $clients = collect();
        $roles = collect();
        $device = Device::where('device_identifier', $token->name)->first();
        $message = 'Client and Roles data has been updated!';

        if($device == null){
            $device = new Device();
            $device->device_identifier = $token->name;
            $device->last_data_sync = now()->subYears(10);
            $device->last_inspection_sync = now()->subDays(7);
            $device->save();
        }

        if($updated_last->data_updated > $device->last_data_sync)
        {
            $clients = Client::query()->select('id', 'name')->where('created_at', '>', $device->last_data_sync)->orWhere('updated_at',
                '>', $device->last_data_sync)->get();
            $roles = Role::query()->select('id', 'role')->where('created_at', '>', $device->last_data_sync)->orWhere('updated_at',
                '>', $device->last_data_sync)->get();
            $device->last_data_sync = now();

        }
        $device->save();
        if($clients->count() == 0 && $roles->count() == 0) {
            $message = "No Update Required";
        }
        return response()->json(['message' => $message, 'clients' => $clients, 'roles' => $roles]);
    }

    public function daysheets(Request $request)
    {

        $body = $request->getContent();
        $user = $request->user();
        $syncedDaysheetIds = [];
        $data = json_decode($body, true);
        foreach ($data['daysheet'] as $daysheet) {
            $clientMileageRate = MileageRate::query()
                ->where('client_id', $daysheet['client_id'])
                ->where('valid_from', '<=' , $daysheet['start_date'])
                ->where(function (Builder $q) use ($daysheet) {
                    return $q->where('valid_to', '>', $daysheet['start_date'])->orWhere('valid_to', null);
            })->first();
            $syncedDaysheetIds[] = $daysheet['id'];
            $newDaysheet = new Daysheet;
            $newDaysheet->client_id = $daysheet['client_id'];
            $newDaysheet->user_id = $user->id;
            $newDaysheet->job_number = $daysheet['job_number'];
            $newDaysheet->issue_fault = $daysheet['issue_fault'];
            $newDaysheet->resolution = $daysheet['resolution'];
            $newDaysheet->site_name = $daysheet['site_name'];
            $newDaysheet->start_date = $daysheet['start_date'];
            $newDaysheet->finish_date = $daysheet['finish_date'];
            $newDaysheet->start_time = $daysheet['start_time'];
            $newDaysheet->finish_time = $daysheet['finish_time'];
            $newDaysheet->signature = $daysheet['signature'];
            $newDaysheet->representative = $daysheet['representative'];
            $newDaysheet->mileage = $daysheet['mileage'];
            $newDaysheet->mileage_rate = $clientMileageRate->rate;
            $newDaysheet->markup_rate = Client::query()->where('id', $daysheet['client_id'])->first()->markup;
            $newDaysheet->save();
            foreach($daysheet['materials'] as $material){
                Material::query()->create([
                    'daysheet_id' => $newDaysheet->id,
                    'name' => $material['name'],
                    'quantity' => $material['quantity'],
                    'cost_per_unit' => $material['cost_per_unit']
                ]);
            }

            $hours = $this->getHours($daysheet['start_date'], $daysheet['start_time'], $daysheet['finish_date'], $daysheet['finish_time']);
            Engineer::query()->create([
                'name' => $user->name,
                'daysheet_id' => $newDaysheet->id,
                'role_id' => 1,
                'rate' => 25.00,
                'hours' => $hours['time'],
                'hours_as_fraction' => $hours['hoursFraction']]);

            foreach($daysheet['engineers'] as $engineer){
                Engineer::query()->create([
                    'name' => $engineer['name'],
                    'daysheet_id' => $newDaysheet->id,
                    'role_id' => $engineer['role_id'],
                    'rate' => 25.00,
                    'hours' => $hours['time'],
                    'hours_as_fraction' => $hours['hoursFraction']]);
            }

        }
        return response()->json(['message' => "All completed daysheets have synced with EPS Daysheet server!!", 'synced_daysheet_ids' => $syncedDaysheetIds]);
    }
}

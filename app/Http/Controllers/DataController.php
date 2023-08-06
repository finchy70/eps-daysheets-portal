<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Daysheet;
use App\Models\Device;
use App\Models\Engineer;
use App\Models\Material;
use App\Models\Update;
use Illuminate\Http\Request;

class DataController extends Controller
{
    public function clients(Request $request)
    {
        $user = $request->user();
        $token = $user->tokens()->first();
        $updated_last = Update::first();
        $clients = collect();
        $device = Device::where('device_identifier', $token->name)->first();
        $message = 'Client and Engineer data has been updated!';

        if($device == null){
            $device = new Device();
            $device->device_identifier = $token->name;
            $device->last_data_sync = now()->subYears(10);
            $device->last_inspection_sync = now()->subDays(7);
            $device->save();
        }

        if($updated_last->data_updated > $device->last_data_sync)
        {
            $clients = Client::where('created_at', '>', $device->last_data_sync)->orWhere('updated_at',
                '>', $device->last_data_sync)->get();
            $device->last_data_sync = now();

        }
        $device->save();
        if($clients->count() == 0) {
            $message = "No Update Required";
        }
        return response()->json(['message' => $message, 'clients' => $clients]);

    }

    public function daysheets(Request $request)
    {
        $body = $request->getContent();
        $user = $request->user();
        $syncedDaysheetIds = [];
        $data = json_decode($body, true);
        foreach ($data['daysheet'] as $daysheet) {
            $syncedDaysheetIds[] = $daysheet['id'];
            $newDaysheet = new Daysheet;
            $newDaysheet->client_id = $daysheet['client_id'];
            $newDaysheet->user_id = $user->id;
            $newDaysheet->job_number = $daysheet['job_number'];
            $newDaysheet->issue_fault = $daysheet['issue_fault'];
            $newDaysheet->resolution = $daysheet['resolution'];
            $newDaysheet->site_name = $daysheet['site_name'];
            $newDaysheet->week_ending = $daysheet['week_ending'];
            $newDaysheet->work_date = $daysheet['work_date'];
            $newDaysheet->start_time = $daysheet['start_time'];
            $newDaysheet->finish_time = $daysheet['finish_time'];
            $newDaysheet->mileage = $daysheet['mileage'];
            $newDaysheet->save();
            foreach($daysheet['materials'] as $material){
                Material::query()->create([
                    'daysheet_id' => $newDaysheet->id,
                    'name' => $material['name'],
                    'quantity' => $material['quantity'],
                    'cost_per_unit' => $material['cost_per_unit']
                ]);
            }
        }
        return response()->json(['message' => "All completed daysheets have synced with EPS Daysheet server!!", 'synced_daysheet_ids' => $syncedDaysheetIds]);
    }
}

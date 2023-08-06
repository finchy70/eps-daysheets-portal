<?php

namespace Database\Seeders;

use App\Models\Daysheet;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DaysheetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $daysheet = new Daysheet;
        $daysheet->client_id = 1;
        $daysheet->client = "Nordex";
        $daysheet->site_name = "Swansea";
        $daysheet->job_number = 3456;
        $daysheet->issue_fault = "HV Trip Out";
        $daysheet->week_ending = '2023-03-05';
        $daysheet->work_date = '2023-03-02';
        $daysheet->start_time = "9 AM";
        $daysheet->finish_time = "6 PM";
        $daysheet->mileage = 212;
        $daysheet->save();
    }
}

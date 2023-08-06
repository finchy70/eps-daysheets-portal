<?php /** @noinspection PhpMultipleClassDeclarationsInspection */

namespace Database\Seeders;

use App\Models\Client;
use App\Models\Daysheet;
use App\Models\Update;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user = new User;

        $user->name = 'Paul Finch';
        $user->email = 'finchy70@gmail.com';
        $user->password = bcrypt('shandy70');
        $user->admin = 1;
        $user->authorised = true;
        $user->save();

        User::factory()->create([
            'name' => 'Lisa Finch',
            'email' => 'lisa.finch@gmail.com',
            'password' => bcrypt('password1')
        ]);

        User::factory()->create([
            'name' => 'Cameron Finch',
            'email' => 'camfinch70@outlook.com',
            'password' => bcrypt('password1')
        ]);

        Client::factory(10)->create();

        Update::query()->create([
           'data_updated' => now(),
           'daysheets_updated' => now()
        ]);

//        $daysheet = new Daysheet;
//        $daysheet->client_id = 1;
//        $daysheet->site_name = "Swansea";
//        $daysheet->engineer_id = 1;
//        $daysheet->job_number = 3456;
//        $daysheet->issue_fault = "HV Trip Out";
//        $daysheet->week_ending = '2023-03-05';
//        $daysheet->work_date = '2023-03-02';
//        $daysheet->start_time = Carbon::parse("9 AM");
//        $daysheet->finish_time = Carbon::parse("6 PM");
//        $daysheet->mileage = 212;
//        $daysheet->save();
    }
}

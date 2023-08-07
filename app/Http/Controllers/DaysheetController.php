<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Daysheet;
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

//    public function update()

}

<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Mileage;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Session;

class MileageController extends Controller
{
    public function index()
    {
        $clients = Client::query()->orderBy('name')->with('currentMileageRate')->paginate(10);
        return view('mileage.index', [
            'clients' => $clients
        ]);
    }

    public function create()
    {
        return view('mileage.create', [
            'rate' => Mileage::query()->orderBy('valid_from', 'desc')->first()

        ]);
    }

    public function edit(Client $client)
    {
        if(auth()->user()->client_id != null){
            Session::flash('error', 'You are not authorised to visit that screen.');
            return redirect(route('menu'));
        }
        $mileages = $client->mileages;
        return view('mileage.edit', [
            'client' => $client,
            'mileages' => $mileages
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'fromDate' => 'required|date',
            'rate' => 'required|numeric|min:0.01'
        ]);
        $lastRate = Mileage::query()->where('client_id', $request->clientId)->orderBy('valid_from', 'desc')->first();
        $lastRate->valid_to = Carbon::parse($request->fromDate)->subDay();
        $lastRate->update();
        Mileage::query()->create([
            'client_id' => $request->clientId,
            'rate' => $request->rate,
            'valid_from' => $request->fromDate
        ]);
        Session::flash('success', 'The new Mileage Rate was successfully added!');
        return redirect(route('mileage.edit', $request->clientId));
    }
}

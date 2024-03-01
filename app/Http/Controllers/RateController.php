<?php

namespace App\Http\Controllers;

use App\Models\Rate;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Session;

class RateController extends Controller
{
    public function edit(Rate $rate)
    {
        $rateToEdit = Rate::query()->where('client_id', $rate->client_id)->where('role_id', $rate->role_id)->orderBy('id', 'desc')->with(['client', 'role'])->get();
        return view('rates.edit', compact('rateToEdit'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'fromDate' => 'required|date',
            'rate' => 'required|numeric|min:0.01'
        ]);
        $lastRate = Rate::query()->where('client_id', $request->clientId)->where('role_id', $request->roleId)->orderBy('id', 'desc')->first();
        $lastRate->valid_to = Carbon::parse($request->fromDate)->subDay()->format('Y-m-d').' 23:59:59';
        $lastRate->update();
        $rate = Rate::query()->create([
            'client_id' => $request->clientId,
            'role_id' => $request->roleId,
            'rate' => $request->rate,
            'valid_from' => $request->fromDate->format('Y-m-d').' 00:00:00'
        ]);
        Session::flash('success', 'The new Rate was successfully added!');
        return redirect(route('rates.edit', $rate->id));
    }
}

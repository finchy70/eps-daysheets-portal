<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Markup;
use App\Models\Mileage;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Session;

class MarkupController extends Controller
{
    public function index()
    {
        $clients = Client::query()->orderBy('name')->with('currentMarkupRate')->paginate(10);
        return view('markup.index', [
            'clients' => $clients
        ]);
    }

    public function edit(Client $client)
    {
        if(auth()->user()->client_id != null){
            Session::flash('error', 'You are not authorised to visit that screen.');
            return redirect(route('menu'));
        }
        $markups = $client->markups;
        return view('markup.edit', [
            'client' => $client,
            'markups' => $markups
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'fromDate' => 'required|date',
            'markup' => 'required|numeric|min:0.01|max:75'
        ]);
        $lastRate = Markup::query()->where('client_id', $request->clientId)->orderBy('valid_from', 'desc')->first();
        $lastRate->valid_to = Carbon::parse($request->fromDate)->subDay()->format('Y-m-d').' 23:59:59';
        $lastRate->update();
        Markup::query()->create([
            'client_id' => $request->clientId,
            'markup' => $request->markup,
            'valid_from' => Carbon::parse($request->fromDate)->format('Y-m-d').' 00:00:00'
        ]);
        Session::flash('success', 'The new Markup Rate was successfully added!');
        return redirect(route('markup.edit', $request->clientId));
    }
}

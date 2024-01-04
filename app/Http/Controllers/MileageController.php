<?php

namespace App\Http\Controllers;

use App\Models\Mileage;
use Illuminate\Http\Request;
use Session;

class MileageController extends Controller
{
    public function index()
    {
        return view('mileage.index', [
            'rates' => Mileage::query()->orderBy('valid_from')->get()
        ]);
    }

    public function create()
    {

        return view('mileage.create', [
            'rate' => Mileage::query()->orderBy('valid_from', 'desc')->first()
        ]);
    }

    public function edit($id)
    {

    }

    public function store(Request $request)
    {
        $request->validate([
            'newRate' => 'required'
        ]);
        $lastRate = Mileage::query()->orderBy('valid_from', 'desc')->first();
        $lastRate->valid_to = now()->subDay();
        $lastRate->update();
        Mileage::query()->create([
            'rate' => $request->newRate,
            'valid_from' => now(),
        ]);
        Session::flash('success', 'The new Mileage Rate was successfully added!');

        return redirect()->action([MileageController::class, 'index']);
    }
}

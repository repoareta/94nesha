<?php

namespace App\Http\Controllers;

// load Request
use Illuminate\Http\Request;
use App\Http\Requests\PenyintasCovidRequest;

// load Model
use App\Models\PenyintasCovid;
use App\Models\Province;

// load Plugin
use RealRashid\SweetAlert\Facades\Alert;
use Carbon\Carbon;

class PenyintasCovidController extends Controller
{
    public function create()
    {
        $provinces = Province::all();
        return view('user.forms.penyintas-covid.create', compact('provinces'));
    }

    public function store(PenyintasCovidRequest $request)
    {
        $request->merge([
            'tgl_positif' => Carbon::parse($request->tgl_positif)->format('Y-m-d'),
            'donor_plasma' => $request->donor_plasma == 'T' ? true : false
        ]);        

        PenyintasCovid::create($request->all());

        Alert::success('Berhasil', 'Data anda berhasil disimpan')->persistent(true)->autoClose(3000);
        return redirect()->route('penyintas_covid.finish');
    }

    public function finish()
    {
        return view('user.forms.penyintas-covid.finish');
    }
}

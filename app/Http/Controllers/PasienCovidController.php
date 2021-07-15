<?php

namespace App\Http\Controllers;

// load Request
use Illuminate\Http\Request;
use App\Http\Requests\PasienCovidRequest;

// load Model
use App\Models\PasienCovid;
use App\Models\Province;

// load Plugin
use RealRashid\SweetAlert\Facades\Alert;
use Carbon\Carbon;

class PasienCovidController extends Controller
{
    public function create()
    {
        $provinces = Province::all();
        return view('user.forms.pasien-covid.create', compact('provinces'));
    }

    public function store(PasienCovidRequest $request)
    {
        $request->merge([
            'tgl_negatif' => Carbon::parse($request->tgl_positif)->format('Y-m-d'),
            'status' => $request->status == '0' ? true : false
        ]);        

        PasienCovid::create($request->all());

        Alert::success('Berhasil', 'Data anda berhasil disimpan')->persistent(true)->autoClose(3000);
        return redirect()->route('pasien_covid.finish');
    }

    public function finish()
    {
        return view('user.forms.pasien-covid.finish');
    }
}

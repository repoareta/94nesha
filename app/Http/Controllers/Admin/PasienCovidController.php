<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

// use Request
use Illuminate\Http\Request;

// use Model
use App\Models\PasienCovid;
use App\Models\PenyintasCovid;

// use Export 
use App\Exports\PasienCovidExport;

// use Plugin
use Yajra\DataTables\Facades\DataTables;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Carbon\Carbon;

class PasienCovidController extends Controller
{

    public function index()
    {
        if(request()->ajax()){
            $Query = PasienCovid::all();
            return DataTables::of($Query)
                ->addIndexColumn()
                ->addColumn('jenkel', function($data){
                    return $data->jenkel == 'L' ? 'Laki-laki' : 'Perempuan';
                })
                ->addColumn('tgl_positif', function($data){
                    return Carbon::parse($data->tgl_positif)->locale('id')->isoFormat('LL');
                })
                ->addColumn('province', function($data){
                    return $data->province->name;
                })
                ->addColumn('regency', function($data){
                    return $data->regency->name;
                })
                ->addColumn('district', function($data){
                    if($data->district){
                        return $data->district->name;
                    }
                })
                ->addColumn('village', function($data){
                    if($data->village){
                        return $data->village->name;
                    }
                })
                ->addColumn('status', function($data){
                    return $data->status == true ? 'Isolasi Mandiri' : 'Rumah Sakit';
                })
                ->addColumn('action', function($data){
                    return '
                        <button class="btn btn-success btn-shadow-hover font-weight-bold mr-2" data-id="'.$data->id.'" id="toPenyintas">Menjadi Penyintas</button>
                        <button class="btn btn-danger btn-shadow-hover font-weight-bold" data-id="'.$data->id.'" id="toMeninggal">Meninggal Dunia</button>
                    ';
                })
                ->rawColumns(['action'])
                ->make();
        }

        return view('admin.report.pasien-covid');
    }

    public function exportExcel()
    {
        return Excel::download(new PasienCovidExport, 'pasien-covid.xlsx');
    }

    public function toPenyintas(Request $request)
    {
        $pasien = PasienCovid::find($request->id);

        $validator = Validator::make($request->all(), [
            'tgl_positif' => 'required|date',
            'donor_plasma' => 'required',
        ]);

        if ($validator->fails()) {
            Alert::error('Error', 'Isi semua input')->persistent(true)->autoClose(4000);
            return redirect()->back();
        }

        $penyintas = new PenyintasCovid();
        $penyintas->nama = $pasien->nama;
        $penyintas->jurusan = $pasien->jurusan;
        $penyintas->nama_kontak = $pasien->nama_kontak;
        $penyintas->no_kontak = $pasien->no_kontak;
        $penyintas->jenkel = $pasien->jenkel;
        $penyintas->goldar = $pasien->goldar;
        $penyintas->tgl_negatif = Carbon::parse($request->tgl_negatif)->format('Y-m-d');
        $penyintas->province_id = $pasien->province_id;
        $penyintas->village_id = $pasien->village_id;
        $penyintas->regency_id = $pasien->regency_id;
        $penyintas->district_id = $pasien->district_id;
        $penyintas->kondisi = $request->kondisi;
        $penyintas->donor_plasma = $request->donor_plasma == 'T' ? true : false;
        $penyintas->save();

        $pasien->delete();
        
        Alert::success('Success', 'Data sudah menjadi penyintas')->persistent(true)->autoClose(4000);
        return redirect()->back();
    }

    public function toMeninggal(Request $request)
    {
        $pasien = PasienCovid::find($request->id);
        
        $validator = Validator::make($request->all(), [
            'tgl_meninggal' => 'required',
        ]);

        if ($validator->fails()) {
            Alert::error('Error', 'Isi semua input')->persistent(true)->autoClose(4000);
            return redirect()->back();
        }

        $pasien->meninggal_dunia = $request->tgl_meninggal . ', ' . $request->keterangan;
        $pasien->save();
        
        Alert::success('Success', 'Data sudah diupdate')->persistent(true)->autoClose(4000);
        return redirect()->back();
    }

}

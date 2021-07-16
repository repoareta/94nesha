<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

// use Request
use Illuminate\Http\Request;

// use Model
use App\Models\PenyintasCovid;

// use Export 
use App\Exports\PenyintasCovidExport;

// use Plugin
use Yajra\DataTables\Facades\DataTables;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;

class PenyintasCovidController extends Controller
{
    public function index()
    {
        if(request()->ajax()){
            $Query = PenyintasCovid::all();
            return DataTables::of($Query)
                ->addIndexColumn()
                ->addColumn('jenkel', function($data){
                    return $data->jenkel == 'L' ? 'Laki-laki' : 'Perempuan';
                })
                ->addColumn('tgl_negatif', function($data){
                    return Carbon::parse($data->tgl_negatif)->locale('id')->isoFormat('LL');
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
                ->addColumn('donor_plasma', function($data){
                    return $data->donor_plasma == true ? 'Iya' : 'Tidak';
                })
                ->make();
        }

        return view('admin.report.penyintas-covid');
    }

    public function exportExcel()
    {
        return Excel::download(new PenyintasCovidExport, 'penyintas-covid.xlsx');
    }
}

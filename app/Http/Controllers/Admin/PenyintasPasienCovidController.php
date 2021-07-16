<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

// use Request
use Illuminate\Http\Request;

// use Model
use App\Models\PenyintasCovid;
use App\Models\PasienCovid;

// use Export 
use App\Exports\PenyintasPasienCovidExport;

// use Plugin
use Yajra\DataTables\Facades\DataTables;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;

class PenyintasPasienCovidController extends Controller
{
    public function index()
    {
        if(request()->ajax()){
            $Query1 = PenyintasCovid::all();
            $Query2 = PasienCovid::all();
            $Query = $Query1->merge($Query2);
            return DataTables::of($Query)
                ->addIndexColumn()
                ->addColumn('jenkel', function($data){
                    return $data->jenkel == 'L' ? 'Laki-laki' : 'Perempuan';
                })
                ->addColumn('tgl_positif', function($data){
                    if($data->tgl_positif){
                        return Carbon::parse($data->tgl_positif)->locale('id')->isoFormat('LL');
                    }
                })
                ->addColumn('tgl_negatif', function($data){
                    if($data->tgl_negatif){
                        return Carbon::parse($data->tgl_negatif)->locale('id')->isoFormat('LL');
                    }
                })
                ->addColumn('province', function($data){
                    if($data->province){
                        return $data->province->name;
                    }
                })
                ->addColumn('regency', function($data){
                    if($data->regency){
                        return $data->regency->name;
                    }
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
                    if($data->status){
                        return $data->status == true ? 'Isolasi Mandiri' : 'Rumah Sakit';
                    }
                })
                ->addColumn('ket_status', function($data){
                    if($data->ket_status){
                        return $data->ket_status;
                    }
                })
                ->addColumn('meninggal_dunia', function($data){
                    if($data->meninggal_dunia){
                        return $data->meninggal_dunia;
                    }
                })
                ->addColumn('kebutuhan', function($data){
                    if($data->kebutuhan){
                        return $data->kebutuhan;
                    }
                })
                ->addColumn('donor_plasma', function($data){
                    if($data->donor_plasma){
                        return $data->donor_plasma == true ? 'Iya' : 'Tidak';
                    }
                })
                ->make();
        }

        return view('admin.report.penyintas-pasien-covid');
    }

    public function exportExcel()
    {
        return Excel::download(new PenyintasPasienCovidExport, 'penyintas-dan-pasien-covid.xlsx');
    }
}

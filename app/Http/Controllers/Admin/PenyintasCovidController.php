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
use App\Charts\MonthlyPenyintasChart;
use App\Charts\ThisDayPenyintasPasienChart;
class PenyintasCovidController extends Controller
{
    public function index(MonthlyPenyintasChart $monthlyChart, ThisDayPenyintasPasienChart $dayChart)
    {
        if(request()->ajax()){
            $Query = PenyintasCovid::orderBy('id', 'DESC');
            return DataTables::of($Query)
                ->addIndexColumn()
                ->setRowClass(function ($data) {
                    $hariIni = Carbon::parse($data->created_at)->format('Y-m-d');
                    return $hariIni == Carbon::now()->format('Y-m-d') ? 'bg-success text-white' : '';
                })
                ->addColumn('jenkel', function($data){
                    return $data->jenkel == 'L' ? 'Laki-laki' : 'Perempuan';
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
                ->addColumn('donor_plasma', function($data){
                    if($data->donor_plasma){
                        return $data->donor_plasma == true ? 'Iya' : 'Tidak';
                    }
                })
                ->make();
        }        
        
        return view('admin.report.penyintas-covid', ['monthlyChart' => $monthlyChart->build(), 'dayChart' => $dayChart->build()]);
    }

    public function exportExcel()
    {
        return Excel::download(new PenyintasCovidExport, 'penyintas-covid.xlsx');
    }
}

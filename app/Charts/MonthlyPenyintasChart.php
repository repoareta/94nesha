<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use App\Models\PenyintasCovid;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class MonthlyPenyintasChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\LineChart
    {
        $penyintas = PenyintasCovid::select('id', 'created_at')
        ->whereYear('created_at', Carbon::now()->format('Y'))
        ->get()
        ->groupBy(function($date) {
            //return Carbon::parse($date->created_at)->format('Y'); // grouping by years
            return Carbon::parse($date->created_at)->format('m'); // grouping by months
        });

        $penyintasmcount = [];
        $penyintasArr = [];

        foreach ($penyintas as $key => $value) {
            $penyintasmcount[(int)$key] = count($value);
        }

        for($i = 0; $i <= 11; $i++){
            if(!empty($penyintasmcount[$i])){
                $penyintasArr[$i] = $penyintasmcount[$i];    
            }else{
                $penyintasArr[$i] = 0;    
            }
        }

        // dd($penyintasArr);
        return $this->chart->lineChart()
            ->setTitle('Penyintas Covid tahun ' . Carbon::now()->format('Y'))
            ->addData('Penyintas Covid', $penyintasArr)
            ->setXAxis([
                'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September',
                'Oktober', 'November', 'Desember']);
    }
}

<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use App\Models\PasienCovid;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class MonthlyPasienChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\LineChart
    {
        $pasien = PasienCovid::select('id', 'created_at')
        ->whereYear('created_at', Carbon::now()->format('Y'))
        ->get()
        ->groupBy(function($date) {
            //return Carbon::parse($date->created_at)->format('Y'); // grouping by years
            return Carbon::parse($date->created_at)->format('m'); // grouping by months
        });

        $pasienmcount = [];
        $pasienArr = [];

        foreach ($pasien as $key => $value) {
            $pasienmcount[(int)$key] = count($value);
        }

        for($i = 0; $i <= 11; $i++){
            if(!empty($pasienmcount[$i])){
                $pasienArr[$i] = $pasienmcount[$i];    
            }else{
                $pasienArr[$i] = 0;    
            }
        }

        // dd($pasienArr);
        return $this->chart->lineChart()
            ->setTitle('Pasien Covid tahun ' . Carbon::now()->format('Y'))
            ->addData('Pasien Covid', $pasienArr)
            ->setXAxis([
                'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September',
                'Oktober', 'November', 'Desember']);
    }
}

<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use App\Models\PasienCovid;
use App\Models\PenyintasCovid;
use Carbon\Carbon;

class ThisDayPenyintasPasienChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\PieChart
    {
        $penyintas = PenyintasCovid::whereDate('created_at', Carbon::now()
                                    ->format('Y-m-d'))
                                    ->get()
                                    ->count();

        $pasien = PasienCovid::whereDate('created_at', Carbon::now()
                                    ->format('Y-m-d'))
                                    ->get()
                                    ->count();

        return $this->chart->pieChart()
            ->setTitle('Pasien & Penyintas Hari Ini')
            ->addData([$penyintas, $pasien])
            ->setLabels(['Penyintas', 'Pasien']);
    }
}

<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use App\Models\Report;
use App\Models\Response;
class TanggapanChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\BarChart
    {
        return $this->chart->barChart()
            ->setTitle('Tanggapan Diagaram')
            ->setSubtitle('Pengaduan vs Tanggapan.')
            ->addData('Tanggapan', [Report::count()])
            ->addData('Pengaduan', [5])
            ->setXAxis(['Pengaduan vs Tanggapan']);
    }
}

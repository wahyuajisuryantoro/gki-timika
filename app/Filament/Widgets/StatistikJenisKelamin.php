<?php

namespace App\Filament\Widgets;

use App\Models\Pendaftaran;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class StatistikJenisKelamin extends ChartWidget
{
    protected static ?string $heading = 'Statistik Status Pendaftaran';

    protected function getData(): array
    {
        $statusCounts = Pendaftaran::select('status_pendaftaran', DB::raw('COUNT(*) as count'))
            ->groupBy('status_pendaftaran')
            ->pluck('count', 'status_pendaftaran')
            ->toArray();
        $labels = ['Pending', 'Approved', 'Rejected'];
        $data = [
            $statusCounts['pending'] ?? 0,
            $statusCounts['approved'] ?? 0,
            $statusCounts['rejected'] ?? 0,
        ];
        $backgroundColors = [
            'rgba(255, 206, 86, 0.6)',
            'rgba(75, 192, 192, 0.6)',
            'rgba(255, 99, 132, 0.6)',
        ];
        $borderColors = [
            'rgba(255, 206, 86, 1)',
            'rgba(75, 192, 192, 1)',
            'rgba(255, 99, 132, 1)',
        ];
        return [
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'Status Pendaftaran',
                    'data' => $data,
                    'backgroundColor' => $backgroundColors,
                    'borderColor' => $borderColors,
                    'borderWidth' => 1,
                ],
            ],
        ];
    }
    protected function getType(): string
    {
        return 'pie';
    }
}

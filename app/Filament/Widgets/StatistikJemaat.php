<?php

namespace App\Filament\Widgets;

use App\Models\Jemaat;
use App\Models\Keluarga;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class StatistikJemaat extends ChartWidget
{
    protected static ?string $heading = 'Statistik Jemaat & Keluarga';

    protected function getData(): array
    { 
        $currentYear = now()->year;
        $years = collect(range($currentYear - 4, $currentYear))->map(fn($year) => (string) $year)->toArray();
        $jemaatData = Jemaat::select(DB::raw('YEAR(created_at) as year'), DB::raw('COUNT(*) as count'))
            ->whereYear('created_at', '>=', $currentYear - 4)
            ->groupBy('year')
            ->pluck('count', 'year')
            ->toArray();
        $keluargaData = Keluarga::select(DB::raw('YEAR(created_at) as year'), DB::raw('COUNT(*) as count'))
            ->whereYear('created_at', '>=', $currentYear - 4)
            ->groupBy('year')
            ->pluck('count', 'year')
            ->toArray();
        $jemaatCounts = array_map(fn($year) => $jemaatData[$year] ?? 0, $years);
        $keluargaCounts = array_map(fn($year) => $keluargaData[$year] ?? 0, $years);
        return [
            'labels' => $years,
            'datasets' => [
                [
                    'label' => 'Jumlah Jemaat',
                    'data' => $jemaatCounts,
                    'backgroundColor' => 'rgba(59, 130, 246, 0.5)',
                    'borderColor' => 'rgba(59, 130, 246, 1)',
                    'borderWidth' => 1,
                ],
                [
                    'label' => 'Jumlah Keluarga',
                    'data' => $keluargaCounts,
                    'backgroundColor' => 'rgba(16, 185, 129, 0.5)',
                    'borderColor' => 'rgba(16, 185, 129, 1)',
                    'borderWidth' => 1,
                ],
            ],
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}

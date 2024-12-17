<?php

namespace App\Filament\Widgets;

use App\Models\Pendaftaran;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatistikPendaftaran extends BaseWidget
{
    protected function getStats(): array
    {
        // Menghitung total pendaftaran
        $totalPendaftaran = Pendaftaran::count();

        // Menghitung jumlah pendaftaran per jenis
        $countBaptis = Pendaftaran::where('jenis_pendaftaran', 'baptis')->count();
        $countSidi = Pendaftaran::where('jenis_pendaftaran', 'sidi')->count();
        $countNikah = Pendaftaran::where('jenis_pendaftaran', 'nikah')->count();

        // Menghitung persentase pendaftaran per jenis
        $percentBaptis = $totalPendaftaran > 0 ? round(($countBaptis / $totalPendaftaran) * 100, 2) : 0;
        $percentSidi = $totalPendaftaran > 0 ? round(($countSidi / $totalPendaftaran) * 100, 2) : 0;
        $percentNikah = $totalPendaftaran > 0 ? round(($countNikah / $totalPendaftaran) * 100, 2) : 0;

        return [
            Stat::make('Baptis', $percentBaptis)
                ->description('Persentase Baptis')
                ->color('blue')
                ->icon('heroicon-o-user-group'),

            Stat::make('Sidi', $percentSidi)
                ->description('Persentase Sidi')
                ->color('green')
                ->icon('heroicon-o-user-group'),

            Stat::make('Nikah', $percentNikah)
                ->description('Persentase Nikah')
                ->color('red')
                ->icon('heroicon-o-user-group'),
        ];
    }
}

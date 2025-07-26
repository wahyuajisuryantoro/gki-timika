<?php

namespace App\Filament\Resources\PendaftaranResource\Pages;

use App\Filament\Resources\PendaftaranResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPendaftarans extends ListRecords
{
    protected static string $resource = PendaftaranResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Tidak ada tombol Create, hanya statistik atau export jika diperlukan
            Actions\Action::make('statistics')
                ->label('Statistik')
                ->icon('heroicon-o-chart-bar')
                ->color('info')
                ->action(function () {
                    $stats = [
                        'total' => \App\Models\Pendaftaran::count(),
                        'pending' => \App\Models\Pendaftaran::where('status_pendaftaran', 'pending')->count(),
                        'approved' => \App\Models\Pendaftaran::where('status_pendaftaran', 'approved')->count(),
                        'rejected' => \App\Models\Pendaftaran::where('status_pendaftaran', 'rejected')->count(),
                        'baptis' => \App\Models\Pendaftaran::where('jenis_pendaftaran', 'baptis')->count(),
                        'sidi' => \App\Models\Pendaftaran::where('jenis_pendaftaran', 'sidi')->count(),
                        'nikah' => \App\Models\Pendaftaran::where('jenis_pendaftaran', 'nikah')->count(),
                    ];
                    
                    \Filament\Notifications\Notification::make()
                        ->title('Statistik Pendaftaran')
                        ->body("Total: {$stats['total']} | Pending: {$stats['pending']} | Approved: {$stats['approved']} | Rejected: {$stats['rejected']} | Baptis: {$stats['baptis']} | Sidi: {$stats['sidi']} | Nikah: {$stats['nikah']}")
                        ->info()
                        ->duration(10000)
                        ->send();
                }),
        ];
    }
}
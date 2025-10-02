<?php

namespace App\Filament\Resources\PendaftaranResource\Pages;

use App\Filament\Resources\PendaftaranResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Filament\Forms;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

class ViewPendaftaran extends ViewRecord
{
    protected static string $resource = PendaftaranResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Status actions
            Actions\Action::make('approve')
                ->label('Setujui Pendaftaran')
                ->icon('heroicon-o-check-circle')
                ->color('success')
                ->action(function () {
                    $this->record->update([
                        'status_pendaftaran' => 'approved',
                        'id_admin' => auth()->id(),
                    ]);

                    Notification::make()
                        ->title('Pendaftaran Disetujui')
                        ->body('Pendaftaran ' . $this->record->nama_lengkap . ' telah disetujui.')
                        ->success()
                        ->send();

                    $this->refreshFormData(['status_pendaftaran']);
                })
                ->requiresConfirmation()
                ->visible(fn(): bool => $this->record->status_pendaftaran === 'pending'),

            Actions\Action::make('reject')
                ->label('Tolak Pendaftaran')
                ->icon('heroicon-o-x-circle')
                ->color('danger')
                ->form([
                    Forms\Components\Textarea::make('catatan')
                        ->label('Alasan Penolakan')
                        ->required()
                        ->rows(4)
                        ->placeholder('Masukkan alasan penolakan pendaftaran...'),
                ])
                ->action(function (array $data) {
                    $this->record->update([
                        'status_pendaftaran' => 'rejected',
                        'catatan' => $data['catatan'],
                        'id_admin' => auth()->id(),
                    ]);

                    Notification::make()
                        ->title('Pendaftaran Ditolak')
                        ->body('Pendaftaran ' . $this->record->nama_lengkap . ' telah ditolak.')
                        ->warning()
                        ->send();

                    $this->refreshFormData(['status_pendaftaran', 'catatan']);
                })
                ->visible(fn(): bool => $this->record->status_pendaftaran === 'pending'),

            Actions\Action::make('reset_status')
                ->label('Reset Status')
                ->icon('heroicon-o-arrow-path')
                ->color('gray')
                ->action(function () {
                    $this->record->update([
                        'status_pendaftaran' => 'pending',
                        'catatan' => null,
                        'id_admin' => null,
                    ]);

                    Notification::make()
                        ->title('Status Direset')
                        ->body('Status pendaftaran ' . $this->record->nama_lengkap . ' telah direset ke pending.')
                        ->info()
                        ->send();

                    $this->refreshFormData(['status_pendaftaran', 'catatan']);
                })
                ->requiresConfirmation()
                ->visible(fn(): bool => in_array($this->record->status_pendaftaran, ['approved', 'rejected'])),

            // Download actions
            Actions\ActionGroup::make([
                Actions\Action::make('download_kk')
                    ->label('Kartu Keluarga')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->action(fn() => $this->downloadFile('kartu_keluarga', 'KK'))
                    ->visible(fn(): bool => !empty($this->record->kartu_keluarga)),

                Actions\Action::make('download_foto')
                    ->label('Pas Foto')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->action(fn() => $this->downloadFile('pas_foto', 'Foto'))
                    ->visible(fn(): bool => !empty($this->record->pas_foto)),

                Actions\Action::make('download_ktp')
                    ->label('KTP')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->action(fn() => $this->downloadFile('ktp', 'KTP'))
                    ->visible(fn(): bool => !empty($this->record->ktp)),

                Actions\Action::make('download_ktp_pasangan')
                    ->label('KTP Pasangan')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->action(fn() => $this->downloadFile('ktp_pasangan', 'KTP_Pasangan'))
                    ->visible(fn(): bool => !empty($this->record->ktp_pasangan)),

                Actions\Action::make('download_surat_baptis')
                    ->label('Surat Baptis')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->action(fn() => $this->downloadFile('surat_baptis', 'Surat_Baptis'))
                    ->visible(fn(): bool => !empty($this->record->surat_baptis)),

                Actions\Action::make('download_surat_sidi')
                    ->label('Surat Sidi')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->action(fn() => $this->downloadFile('surat_sidi', 'Surat_Sidi'))
                    ->visible(fn(): bool => !empty($this->record->surat_sidi)),
                Actions\Action::make('download_kk_pasangan')
                    ->label('KK Pasangan')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->action(fn() => $this->downloadFile('kartu_keluarga_pasangan', 'KK_Pasangan'))
                    ->visible(fn(): bool => !empty($this->record->kartu_keluarga_pasangan)),

                Actions\Action::make('download_surat_baptis_pasangan')
                    ->label('Surat Baptis Pasangan')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->action(fn() => $this->downloadFile('surat_baptis_pasangan', 'Surat_Baptis_Pasangan'))
                    ->visible(fn(): bool => !empty($this->record->surat_baptis_pasangan)),

                Actions\Action::make('download_surat_sidi_pasangan')
                    ->label('Surat Sidi Pasangan')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->action(fn() => $this->downloadFile('surat_sidi_pasangan', 'Surat_Sidi_Pasangan'))
                    ->visible(fn(): bool => !empty($this->record->surat_sidi_pasangan)),

                Actions\Action::make('download_foto_pasangan')
                    ->label('Pas Foto Pasangan')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->action(fn() => $this->downloadFile('pas_foto_pasangan', 'Foto_Pasangan'))
                    ->visible(fn(): bool => !empty($this->record->pas_foto_pasangan)),
            ])
                ->label('Download Dokumen')
                ->icon('heroicon-o-arrow-down-tray')
                ->color('primary'),
        ];
    }

    private function downloadFile(string $field, string $prefix): mixed
    {
        if (!$this->record->$field) {
            Notification::make()
                ->title('File tidak ditemukan')
                ->body("File {$prefix} tidak tersedia untuk pendaftaran ini.")
                ->danger()
                ->send();
            return null;
        }

        // Check file locations
        $publicPath = public_path('storage/' . $this->record->$field);
        $storagePath = \Illuminate\Support\Facades\Storage::disk('public')->path($this->record->$field);

        $filePath = null;
        if (file_exists($publicPath)) {
            $filePath = $publicPath;
        } elseif (\Illuminate\Support\Facades\Storage::disk('public')->exists($this->record->$field)) {
            $filePath = $storagePath;
        } elseif (\Illuminate\Support\Facades\Storage::exists($this->record->$field)) {
            $filePath = \Illuminate\Support\Facades\Storage::path($this->record->$field);
        }

        if (!$filePath || !file_exists($filePath)) {
            Notification::make()
                ->title('File tidak ditemukan')
                ->body("File {$prefix} tidak ditemukan di server. Path: " . $this->record->$field)
                ->danger()
                ->send();
            return null;
        }

        $fileName = $prefix . '_' . str_replace(' ', '_', $this->record->nama_lengkap) . '_' . now()->format('Y-m-d') . '.' . pathinfo($this->record->$field, PATHINFO_EXTENSION);

        return \Illuminate\Support\Facades\Response::download($filePath, $fileName);
    }
}
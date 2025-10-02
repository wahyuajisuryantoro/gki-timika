<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PendaftaranResource\Pages;
use App\Filament\Resources\PendaftaranResource\RelationManagers;
use App\Models\Pendaftaran;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Infolists;
use Filament\Infolists\Infolist;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use Filament\Notifications\Notification;

class PendaftaranResource extends Resource
{
    protected static ?string $model = Pendaftaran::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $modelLabel = 'pendaftaran';
    protected static ?string $pluralModelLabel = 'pendaftaran';

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Infolists\Components\Section::make('Informasi Pendaftaran')
                    ->schema([
                        Infolists\Components\Grid::make(3)
                            ->schema([
                                Infolists\Components\TextEntry::make('nomor_induk_jemaat')
                                    ->label('Nomor Induk Jemaat')
                                    ->weight('bold')
                                    ->color('primary'),

                                Infolists\Components\TextEntry::make('jenis_pendaftaran')
                                    ->label('Jenis Pendaftaran')
                                    ->badge()
                                    ->color(fn(string $state): string => match ($state) {
                                        'baptis' => 'info',
                                        'sidi' => 'success',
                                        'nikah' => 'warning',
                                        default => 'gray',
                                    }),

                                Infolists\Components\TextEntry::make('status_pendaftaran')
                                    ->label('Status')
                                    ->badge()
                                    ->color(fn(string $state): string => match ($state) {
                                        'pending' => 'warning',
                                        'approved' => 'success',
                                        'rejected' => 'danger',
                                        default => 'gray',
                                    }),
                            ]),
                    ]),

                Infolists\Components\Section::make('Data Pribadi')
                    ->schema([
                        Infolists\Components\Grid::make(3)
                            ->schema([
                                Infolists\Components\TextEntry::make('nama_lengkap')
                                    ->label('Nama Lengkap')
                                    ->weight('bold'),
                                Infolists\Components\TextEntry::make('alamat_pendaftar')
                                    ->label('Alamat Pendaftar')
                                    ->visible(fn($record) => !empty($record->alamat_pendaftar)),


                                Infolists\Components\TextEntry::make('jenis_kelamin')
                                    ->label('Jenis Kelamin')
                                    ->formatStateUsing(fn(string $state): string => $state === 'L' ? 'Laki-laki' : 'Perempuan'),

                                Infolists\Components\TextEntry::make('tanggal_lahir')
                                    ->label('Tanggal Lahir')
                                    ->date('d F Y'),

                                Infolists\Components\TextEntry::make('tempat_lahir')
                                    ->label('Tempat Lahir'),

                                Infolists\Components\TextEntry::make('nama_ayah')
                                    ->label('Nama Ayah')
                                    ->visible(fn($record) => !empty($record->nama_ayah)),

                                Infolists\Components\TextEntry::make('nama_ibu')
                                    ->label('Nama Ibu')
                                    ->visible(fn($record) => !empty($record->nama_ibu)),
                            ]),
                    ]),

                Infolists\Components\Section::make('Data Pasangan')
                    ->schema([
                        Infolists\Components\Grid::make(3)
                            ->schema([
                                Infolists\Components\TextEntry::make('nomor_induk_jemaat_pasangan')
                                    ->label('NIJ Pasangan')
                                    ->visible(fn($record) => !empty($record->nomor_induk_jemaat_pasangan)),

                                Infolists\Components\TextEntry::make('pasanganJemaat.nama_lengkap')
                                    ->label('Nama Pasangan (Jemaat)')
                                    ->visible(fn($record) => !empty($record->nomor_induk_jemaat_pasangan)),

                                Infolists\Components\TextEntry::make('nama_pasangan')
                                    ->label('Nama Pasangan')
                                    ->visible(fn($record): bool => !empty($record->nama_pasangan)),

                                Infolists\Components\TextEntry::make('alamat_pasangan')
                                    ->label('Alamat Pasangan')
                                    ->visible(fn($record) => !empty($record->alamat_pasangan)),


                                Infolists\Components\TextEntry::make('nama_ayah_pasangan')
                                    ->label('Nama Ayah Pasangan')
                                    ->visible(fn($record) => !empty($record->nama_ayah_pasangan)),

                                Infolists\Components\TextEntry::make('nama_ibu_pasangan')
                                    ->label('Nama Ibu Pasangan')
                                    ->visible(fn($record) => !empty($record->nama_ibu_pasangan)),
                            ]),
                    ])
                    ->visible(fn($record) => $record->jenis_pendaftaran === 'nikah'),

                Infolists\Components\Section::make('Data Saksi')
                    ->schema([
                        Infolists\Components\Grid::make(2)
                            ->schema([
                                Infolists\Components\TextEntry::make('saksi1')
                                    ->label('Saksi 1')
                                    ->visible(fn($record) => !empty($record->saksi1)),

                                Infolists\Components\TextEntry::make('saksi2')
                                    ->label('Saksi 2')
                                    ->visible(fn($record) => !empty($record->saksi2)),
                            ]),
                    ])
                    ->visible(fn($record) => $record->jenis_pendaftaran === 'nikah' && (!empty($record->saksi1) || !empty($record->saksi2))),

                Infolists\Components\Section::make('Informasi Tanggal')
                    ->schema([
                        Infolists\Components\Grid::make(2)
                            ->schema([
                                Infolists\Components\TextEntry::make('tanggal_pendaftaran')
                                    ->label('Tanggal Pendaftaran')
                                    ->dateTime('d F Y, H:i'),

                                Infolists\Components\TextEntry::make('tanggal_pelaksanaan')
                                    ->label('Tanggal Pelaksanaan')
                                    ->date('d F Y'),
                            ]),
                    ]),

                Infolists\Components\Section::make('Dokumen Pendaftar')
                    ->schema([
                        Infolists\Components\Grid::make(4)
                            ->schema([
                                Infolists\Components\ImageEntry::make('kartu_keluarga')
                                    ->label('Kartu Keluarga')
                                    ->disk('public')
                                    ->height(100)
                                    ->visible(fn($record) => !empty($record->kartu_keluarga)),

                                Infolists\Components\ImageEntry::make('pas_foto')
                                    ->label('Pas Foto')
                                    ->disk('public')
                                    ->height(100)
                                    ->visible(fn($record) => !empty($record->pas_foto)),

                                Infolists\Components\ImageEntry::make('ktp')
                                    ->label('KTP')
                                    ->disk('public')
                                    ->height(100)
                                    ->visible(fn($record) => !empty($record->ktp)),
                            ]),

                        Infolists\Components\Grid::make(2)
                            ->schema([
                                Infolists\Components\ImageEntry::make('surat_baptis')
                                    ->label('Surat Baptis')
                                    ->disk('public')
                                    ->height(100)
                                    ->visible(fn($record) => !empty($record->surat_baptis)),

                                Infolists\Components\ImageEntry::make('surat_sidi')
                                    ->label('Surat Sidi')
                                    ->disk('public')
                                    ->height(100)
                                    ->visible(fn($record) => !empty($record->surat_sidi)),
                            ]),
                    ]),

                Infolists\Components\Section::make('Dokumen Pasangan')
                    ->schema([
                        Infolists\Components\Grid::make(4)
                            ->schema([
                                Infolists\Components\ImageEntry::make('ktp_pasangan')
                                    ->label('KTP Pasangan')
                                    ->disk('public')
                                    ->height(100)
                                    ->visible(fn($record) => !empty($record->ktp_pasangan)),

                                Infolists\Components\ImageEntry::make('kartu_keluarga_pasangan')
                                    ->label('KK Pasangan')
                                    ->disk('public')
                                    ->height(100)
                                    ->visible(fn($record) => !empty($record->kartu_keluarga_pasangan)),

                                Infolists\Components\ImageEntry::make('pas_foto_pasangan')
                                    ->label('Pas Foto Pasangan')
                                    ->disk('public')
                                    ->height(100)
                                    ->visible(fn($record) => !empty($record->pas_foto_pasangan)),
                            ]),

                        Infolists\Components\Grid::make(2)
                            ->schema([
                                Infolists\Components\ImageEntry::make('surat_baptis_pasangan')
                                    ->label('Surat Baptis Pasangan')
                                    ->disk('public')
                                    ->height(100)
                                    ->visible(fn($record) => !empty($record->surat_baptis_pasangan)),

                                Infolists\Components\ImageEntry::make('surat_sidi_pasangan')
                                    ->label('Surat Sidi Pasangan')
                                    ->disk('public')
                                    ->height(100)
                                    ->visible(fn($record) => !empty($record->surat_sidi_pasangan)),
                            ]),
                    ])
                    ->visible(fn($record) => $record->jenis_pendaftaran === 'nikah'),


                Infolists\Components\Section::make('Catatan')
                    ->schema([
                        Infolists\Components\TextEntry::make('catatan')
                            ->label('Catatan')
                            ->prose()
                            ->visible(fn($record) => !empty($record->catatan)),
                    ])
                    ->visible(fn($record) => !empty($record->catatan)),

                Infolists\Components\Section::make('Informasi Tambahan')
                    ->schema([
                        Infolists\Components\Grid::make(3)
                            ->schema([
                                Infolists\Components\TextEntry::make('jemaat.nama_lengkap')
                                    ->label('Data Jemaat'),

                                Infolists\Components\TextEntry::make('admin.name')
                                    ->label('Diproses oleh Admin')
                                    ->visible(fn($record) => !empty($record->admin)),

                                Infolists\Components\TextEntry::make('updated_at')
                                    ->label('Terakhir Diupdate')
                                    ->dateTime('d F Y, H:i'),
                            ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nomor_induk_jemaat')
                    ->label('NIJ')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('jenis_pendaftaran')
                    ->label('Jenis')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'baptis' => 'info',
                        'sidi' => 'success',
                        'nikah' => 'warning',
                        default => 'gray',
                    })
                    ->searchable(),

                Tables\Columns\TextColumn::make('nama_lengkap')
                    ->label('Nama Lengkap')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('tanggal_pendaftaran')
                    ->label('Tgl. Pendaftaran')
                    ->dateTime('d/m/Y')
                    ->sortable(),

                Tables\Columns\TextColumn::make('tanggal_pelaksanaan')
                    ->label('Tgl. Pelaksanaan')
                    ->date('d/m/Y')
                    ->sortable(),

                Tables\Columns\TextColumn::make('status_pendaftaran')
                    ->label('Status')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'pending' => 'warning',
                        'approved' => 'success',
                        'rejected' => 'danger',
                        default => 'gray',
                    }),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('jenis_pendaftaran')
                    ->label('Jenis Pendaftaran')
                    ->options([
                        'baptis' => 'Baptis',
                        'sidi' => 'Sidi',
                        'nikah' => 'Nikah',
                    ])
                    ->native(false),

                Tables\Filters\SelectFilter::make('status_pendaftaran')
                    ->label('Status Pendaftaran')
                    ->options([
                        'pending' => 'Pending',
                        'approved' => 'Approved',
                        'rejected' => 'Rejected',
                    ])
                    ->native(false),

                Tables\Filters\Filter::make('tanggal_pelaksanaan')
                    ->form([
                        Forms\Components\DatePicker::make('dari_tanggal')
                            ->label('Dari Tanggal'),
                        Forms\Components\DatePicker::make('sampai_tanggal')
                            ->label('Sampai Tanggal'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['dari_tanggal'],
                                fn(Builder $query, $date): Builder => $query->whereDate('tanggal_pelaksanaan', '>=', $date),
                            )
                            ->when(
                                $data['sampai_tanggal'],
                                fn(Builder $query, $date): Builder => $query->whereDate('tanggal_pelaksanaan', '<=', $date),
                            );
                    }),
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->label('Detail'),

                Tables\Actions\ActionGroup::make([
                    // Download actions
                    Tables\Actions\Action::make('download_kk')
                        ->label('Download KK')
                        ->icon('heroicon-o-arrow-down-tray')
                        ->color('primary')
                        ->action(function (Pendaftaran $record) {
                            return self::downloadFile($record, 'kartu_keluarga', 'KK');
                        })
                        ->visible(fn(Pendaftaran $record): bool => !empty($record->kartu_keluarga)),

                    Tables\Actions\Action::make('download_foto')
                        ->label('Download Foto')
                        ->icon('heroicon-o-arrow-down-tray')
                        ->color('info')
                        ->action(function (Pendaftaran $record) {
                            return self::downloadFile($record, 'pas_foto', 'Foto');
                        })
                        ->visible(fn(Pendaftaran $record): bool => !empty($record->pas_foto)),

                    Tables\Actions\Action::make('download_ktp')
                        ->label('Download KTP')
                        ->icon('heroicon-o-arrow-down-tray')
                        ->color('warning')
                        ->action(function (Pendaftaran $record) {
                            return self::downloadFile($record, 'ktp', 'KTP');
                        })
                        ->visible(fn(Pendaftaran $record): bool => !empty($record->ktp)),

                    Tables\Actions\Action::make('download_ktp_pasangan')
                        ->label('Download KTP Pasangan')
                        ->icon('heroicon-o-arrow-down-tray')
                        ->color('warning')
                        ->action(function (Pendaftaran $record) {
                            return self::downloadFile($record, 'ktp_pasangan', 'KTP_Pasangan');
                        })
                        ->visible(fn(Pendaftaran $record): bool => !empty($record->ktp_pasangan)),

                    Tables\Actions\Action::make('download_surat_baptis')
                        ->label('Download Surat Baptis')
                        ->icon('heroicon-o-arrow-down-tray')
                        ->color('success')
                        ->action(function (Pendaftaran $record) {
                            return self::downloadFile($record, 'surat_baptis', 'Surat_Baptis');
                        })
                        ->visible(fn(Pendaftaran $record): bool => !empty($record->surat_baptis)),

                    Tables\Actions\Action::make('download_surat_sidi')
                        ->label('Download Surat Sidi')
                        ->icon('heroicon-o-arrow-down-tray')
                        ->color('success')
                        ->action(function (Pendaftaran $record) {
                            return self::downloadFile($record, 'surat_sidi', 'Surat_Sidi');
                        })
                        ->visible(fn(Pendaftaran $record): bool => !empty($record->surat_sidi)),
                ])
                    ->label('Download')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->size('sm')
                    ->button(),

                Tables\Actions\ActionGroup::make([
                    Tables\Actions\Action::make('approve')
                        ->label('Setujui')
                        ->icon('heroicon-o-check-circle')
                        ->color('success')
                        ->action(function (Pendaftaran $record) {
                            $record->update([
                                'status_pendaftaran' => 'approved',
                                'id_admin' => auth()->id(),
                            ]);

                            Notification::make()
                                ->title('Pendaftaran Disetujui')
                                ->body('Pendaftaran ' . $record->nama_lengkap . ' telah disetujui.')
                                ->success()
                                ->send();
                        })
                        ->requiresConfirmation()
                        ->visible(fn(Pendaftaran $record): bool => $record->status_pendaftaran === 'pending'),

                    Tables\Actions\Action::make('reject')
                        ->label('Tolak')
                        ->icon('heroicon-o-x-circle')
                        ->color('danger')
                        ->form([
                            Forms\Components\Textarea::make('catatan')
                                ->label('Alasan Penolakan')
                                ->required()
                                ->rows(3),
                        ])
                        ->action(function (Pendaftaran $record, array $data) {
                            $record->update([
                                'status_pendaftaran' => 'rejected',
                                'catatan' => $data['catatan'],
                                'id_admin' => auth()->id(),
                            ]);

                            Notification::make()
                                ->title('Pendaftaran Ditolak')
                                ->body('Pendaftaran ' . $record->nama_lengkap . ' telah ditolak.')
                                ->warning()
                                ->send();
                        })
                        ->visible(fn(Pendaftaran $record): bool => $record->status_pendaftaran === 'pending'),

                    Tables\Actions\Action::make('reset_status')
                        ->label('Reset ke Pending')
                        ->icon('heroicon-o-arrow-path')
                        ->color('gray')
                        ->action(function (Pendaftaran $record) {
                            $record->update([
                                'status_pendaftaran' => 'pending',
                                'catatan' => null,
                                'id_admin' => null,
                            ]);

                            Notification::make()
                                ->title('Status Direset')
                                ->body('Status pendaftaran ' . $record->nama_lengkap . ' telah direset ke pending.')
                                ->info()
                                ->send();
                        })
                        ->requiresConfirmation()
                        ->visible(fn(Pendaftaran $record): bool => in_array($record->status_pendaftaran, ['approved', 'rejected'])),
                ])
                    ->label('Status')
                    ->icon('heroicon-o-cog-6-tooth')
                    ->size('sm')
                    ->button(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\BulkAction::make('bulk_approve')
                        ->label('Setujui Terpilih')
                        ->icon('heroicon-o-check-circle')
                        ->color('success')
                        ->action(function ($records) {
                            $approved = 0;
                            $records->each(function ($record) use (&$approved) {
                                if ($record->status_pendaftaran === 'pending') {
                                    $record->update([
                                        'status_pendaftaran' => 'approved',
                                        'id_admin' => auth()->id(),
                                    ]);
                                    $approved++;
                                }
                            });

                            Notification::make()
                                ->title('Pendaftaran Disetujui')
                                ->body($approved . ' pendaftaran telah disetujui.')
                                ->success()
                                ->send();
                        })
                        ->requiresConfirmation(),

                    Tables\Actions\BulkAction::make('bulk_reject')
                        ->label('Tolak Terpilih')
                        ->icon('heroicon-o-x-circle')
                        ->color('danger')
                        ->form([
                            Forms\Components\Textarea::make('catatan')
                                ->label('Alasan Penolakan')
                                ->required()
                                ->rows(3),
                        ])
                        ->action(function ($records, array $data) {
                            $rejected = 0;
                            $records->each(function ($record) use (&$rejected, $data) {
                                if ($record->status_pendaftaran === 'pending') {
                                    $record->update([
                                        'status_pendaftaran' => 'rejected',
                                        'catatan' => $data['catatan'],
                                        'id_admin' => auth()->id(),
                                    ]);
                                    $rejected++;
                                }
                            });

                            Notification::make()
                                ->title('Pendaftaran Ditolak')
                                ->body($rejected . ' pendaftaran telah ditolak.')
                                ->warning()
                                ->send();
                        })
                        ->requiresConfirmation(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }

    protected static function downloadFile(Pendaftaran $record, string $field, string $prefix): mixed
    {
        if (!$record->$field) {
            Notification::make()
                ->title('File tidak ditemukan')
                ->body("File {$prefix} tidak tersedia untuk pendaftaran ini.")
                ->danger()
                ->send();
            return null;
        }

        // Check file locations
        $publicPath = public_path('storage/' . $record->$field);
        $storagePath = Storage::disk('public')->path($record->$field);

        $filePath = null;
        if (file_exists($publicPath)) {
            $filePath = $publicPath;
        } elseif (Storage::disk('public')->exists($record->$field)) {
            $filePath = $storagePath;
        } elseif (Storage::exists($record->$field)) {
            $filePath = Storage::path($record->$field);
        }

        if (!$filePath || !file_exists($filePath)) {
            Notification::make()
                ->title('File tidak ditemukan')
                ->body("File {$prefix} tidak ditemukan di server. Path: " . $record->$field)
                ->danger()
                ->send();
            return null;
        }

        $fileName = $prefix . '_' . str_replace(' ', '_', $record->nama_lengkap) . '_' . now()->format('Y-m-d') . '.' . pathinfo($record->$field, PATHINFO_EXTENSION);

        return Response::download($filePath, $fileName);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPendaftarans::route('/'),
            'view' => Pages\ViewPendaftaran::route('/{record}'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::where('status_pendaftaran', 'pending')->count();
    }

    public static function getNavigationBadgeColor(): string|array|null
    {
        $pendingCount = static::getModel()::where('status_pendaftaran', 'pending')->count();
        return $pendingCount > 0 ? 'warning' : null;
    }
}
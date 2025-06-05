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

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make()
                    ->schema([
                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('nomor_induk_jemaat')
                                    ->label('Nomor Induk Jemaat')
                                    ->required()
                                    ->maxLength(255),
                                
                                Forms\Components\Select::make('jenis_pendaftaran')
                                    ->label('Jenis Pendaftaran')
                                    ->options([
                                        'baptis' => 'Baptis',
                                        'sidi' => 'Sidi',
                                        'nikah' => 'Nikah',
                                    ])
                                    ->required()
                                    ->native(false),
                                
                                Forms\Components\TextInput::make('nama_lengkap')
                                    ->label('Nama Lengkap')
                                    ->required()
                                    ->maxLength(255),
                                
                                Forms\Components\Select::make('jenis_kelamin')
                                    ->label('Jenis Kelamin')
                                    ->options([
                                        'L' => 'Laki-laki',
                                        'P' => 'Perempuan',
                                    ])
                                    ->required()
                                    ->native(false),
                                
                                Forms\Components\TextInput::make('tempat_lahir')
                                    ->label('Tempat Lahir')
                                    ->required()
                                    ->maxLength(255),
                                
                                Forms\Components\DatePicker::make('tanggal_lahir')
                                    ->label('Tanggal Lahir')
                                    ->required()
                                    ->native(false),
                                
                                Forms\Components\TextInput::make('nama_ayah')
                                    ->label('Nama Ayah')
                                    ->required()
                                    ->maxLength(255),
                                
                                Forms\Components\TextInput::make('nama_ibu')
                                    ->label('Nama Ibu')
                                    ->required()
                                    ->maxLength(255),
                                
                                Forms\Components\TextInput::make('saksi1')
                                    ->label('Saksi 1')
                                    ->maxLength(255),
                                
                                Forms\Components\TextInput::make('saksi2')
                                    ->label('Saksi 2')
                                    ->maxLength(255),
                                
                                Forms\Components\DatePicker::make('tanggal_pelaksanaan')
                                    ->label('Tanggal Pelaksanaan')
                                    ->required()
                                    ->native(false),
                                
                                Forms\Components\Select::make('status_pendaftaran')
                                    ->label('Status Pendaftaran')
                                    ->options([
                                        'pending' => 'Pending',
                                        'approved' => 'Approved',
                                        'rejected' => 'Rejected',
                                    ])
                                    ->required()
                                    ->native(false),
                            ]),
                        
                        Forms\Components\Textarea::make('catatan')
                            ->label('Catatan')
                            ->maxLength(65535)
                            ->rows(4)
                            ->columnSpanFull(),
                        
                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\FileUpload::make('kartu_keluarga')
                                    ->label('Kartu Keluarga')
                                    ->image()
                                    ->directory('kartu_keluarga')
                                    ->disk('public')
                                    ->visibility('public')
                                    ->maxSize(5120)
                                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/jpg', 'application/pdf']),
                                
                                Forms\Components\FileUpload::make('pas_foto')
                                    ->label('Pas Foto')
                                    ->image()
                                    ->directory('pas_foto')
                                    ->disk('public')
                                    ->visibility('public')
                                    ->maxSize(2048)
                                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/jpg']),
                            ]),
                    ])
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
                    ->color(fn (string $state): string => match ($state) {
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
                    ->color(fn (string $state): string => match ($state) {
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
                                fn (Builder $query, $date): Builder => $query->whereDate('tanggal_pelaksanaan', '>=', $date),
                            )
                            ->when(
                                $data['sampai_tanggal'],
                                fn (Builder $query, $date): Builder => $query->whereDate('tanggal_pelaksanaan', '<=', $date),
                            );
                    }),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                
                Tables\Actions\Action::make('download_kk')
                    ->label('Download KK')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->color('primary')
                    ->action(function (Pendaftaran $record) {
                        if (!$record->kartu_keluarga) {
                            Notification::make()
                                ->title('File tidak ditemukan')
                                ->body('File Kartu Keluarga tidak tersedia untuk pendaftaran ini.')
                                ->danger()
                                ->send();
                            return;
                        }

                        // Cek di public storage
                        $publicPath = public_path('storage/' . $record->kartu_keluarga);
                        $storagePath = Storage::disk('public')->path($record->kartu_keluarga);
                        
                        $filePath = null;
                        if (file_exists($publicPath)) {
                            $filePath = $publicPath;
                        } elseif (Storage::disk('public')->exists($record->kartu_keluarga)) {
                            $filePath = $storagePath;
                        } elseif (Storage::exists($record->kartu_keluarga)) {
                            $filePath = Storage::path($record->kartu_keluarga);
                        }

                        if (!$filePath || !file_exists($filePath)) {
                            Notification::make()
                                ->title('File tidak ditemukan')
                                ->body('File Kartu Keluarga tidak ditemukan di server. Path: ' . $record->kartu_keluarga)
                                ->danger()
                                ->send();
                            return;
                        }

                        $fileName = 'KK_' . str_replace(' ', '_', $record->nama_lengkap) . '_' . now()->format('Y-m-d') . '.' . pathinfo($record->kartu_keluarga, PATHINFO_EXTENSION);
                        
                        return Response::download($filePath, $fileName);
                    })
                    ->visible(fn (Pendaftaran $record): bool => !empty($record->kartu_keluarga)),
                
                Tables\Actions\Action::make('download_foto')
                    ->label('Download Foto')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->color('secondary')
                    ->action(function (Pendaftaran $record) {
                        if (!$record->pas_foto) {
                            Notification::make()
                                ->title('File tidak ditemukan')
                                ->body('File Pas Foto tidak tersedia untuk pendaftaran ini.')
                                ->danger()
                                ->send();
                            return;
                        }

                        // Cek di public storage
                        $publicPath = public_path('storage/' . $record->pas_foto);
                        $storagePath = Storage::disk('public')->path($record->pas_foto);
                        
                        $filePath = null;
                        if (file_exists($publicPath)) {
                            $filePath = $publicPath;
                        } elseif (Storage::disk('public')->exists($record->pas_foto)) {
                            $filePath = $storagePath;
                        } elseif (Storage::exists($record->pas_foto)) {
                            $filePath = Storage::path($record->pas_foto);
                        }

                        if (!$filePath || !file_exists($filePath)) {
                            Notification::make()
                                ->title('File tidak ditemukan')
                                ->body('File Pas Foto tidak ditemukan di server. Path: ' . $record->pas_foto)
                                ->danger()
                                ->send();
                            return;
                        }

                        $fileName = 'Foto_' . str_replace(' ', '_', $record->nama_lengkap) . '_' . now()->format('Y-m-d') . '.' . pathinfo($record->pas_foto, PATHINFO_EXTENSION);
                        
                        return Response::download($filePath, $fileName);
                    })
                    ->visible(fn (Pendaftaran $record): bool => !empty($record->pas_foto)),

                Tables\Actions\ActionGroup::make([
                    Tables\Actions\Action::make('approve')
                        ->label('Setujui')
                        ->icon('heroicon-o-check-circle')
                        ->color('success')
                        ->action(function (Pendaftaran $record) {
                            $record->update(['status_pendaftaran' => 'approved']);
                            
                            Notification::make()
                                ->title('Pendaftaran Disetujui')
                                ->body('Pendaftaran ' . $record->nama_lengkap . ' telah disetujui.')
                                ->success()
                                ->send();
                        })
                        ->requiresConfirmation()
                        ->visible(fn (Pendaftaran $record): bool => $record->status_pendaftaran === 'pending'),

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
                            ]);
                            
                            Notification::make()
                                ->title('Pendaftaran Ditolak')
                                ->body('Pendaftaran ' . $record->nama_lengkap . ' telah ditolak.')
                                ->warning()
                                ->send();
                        })
                        ->visible(fn (Pendaftaran $record): bool => $record->status_pendaftaran === 'pending'),
                ])
                ->label('Status')
                ->icon('heroicon-o-cog-6-tooth')
                ->size('sm')
                ->button(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    
                    Tables\Actions\BulkAction::make('bulk_approve')
                        ->label('Setujui Terpilih')
                        ->icon('heroicon-o-check-circle')
                        ->color('success')
                        ->action(function ($records) {
                            $records->each(function ($record) {
                                if ($record->status_pendaftaran === 'pending') {
                                    $record->update(['status_pendaftaran' => 'approved']);
                                }
                            });
                            
                            Notification::make()
                                ->title('Pendaftaran Disetujui')
                                ->body('Pendaftaran yang dipilih telah disetujui.')
                                ->success()
                                ->send();
                        })
                        ->requiresConfirmation(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
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
            'create' => Pages\CreatePendaftaran::route('/create'),
            'edit' => Pages\EditPendaftaran::route('/{record}/edit'),
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
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
                Forms\Components\TextInput::make('nomor_induk_jemaat')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('jenis_pendaftaran')
                    ->options([
                        'baptis' => 'Baptis',
                        'sidi' => 'Sidi',
                        'nikah' => 'Nikah',
                    ])
                    ->required(),
                Forms\Components\TextInput::make('nama_lengkap')
                    ->required()
                    ->maxLength(255),
                Forms\Components\DatePicker::make('tanggal_lahir')
                    ->required(),
                Forms\Components\TextInput::make('tempat_lahir')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('jenis_kelamin')
                    ->options([
                        'L' => 'Laki-laki',
                        'P' => 'Perempuan',
                    ])
                    ->required(),
                Forms\Components\TextInput::make('nama_ayah')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('nama_ibu')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('saksi1')
                    ->maxLength(255),
                Forms\Components\TextInput::make('saksi2')
                    ->maxLength(255),
                Forms\Components\DatePicker::make('tanggal_pelaksanaan')
                    ->required(),
                Forms\Components\Select::make('status_pendaftaran')
                    ->options([
                        'pending' => 'Pending',
                        'approved' => 'Approved',
                        'rejected' => 'Rejected',
                    ])
                    ->required(),
                Forms\Components\Textarea::make('catatan')
                    ->maxLength(65535),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nomor_induk_jemaat'),
                Tables\Columns\TextColumn::make('jenis_pendaftaran'),
                Tables\Columns\TextColumn::make('nama_lengkap'),
                Tables\Columns\TextColumn::make('tanggal_pendaftaran')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('tanggal_pelaksanaan')
                    ->date(),
                Tables\Columns\BadgeColumn::make('status_pendaftaran')
                    ->colors([
                        'warning' => 'pending',
                        'success' => 'approved',
                        'danger' => 'rejected',
                    ]),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('jenis_pendaftaran')
                    ->options([
                        'baptis' => 'Baptis',
                        'sidi' => 'Sidi',
                        'nikah' => 'Nikah',
                    ]),
                Tables\Filters\SelectFilter::make('status_pendaftaran')
                    ->options([
                        'pending' => 'Pending',
                        'approved' => 'Approved',
                        'rejected' => 'Rejected',
                    ]),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('download_kk')
                    ->label('Download KK')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->url(fn(Pendaftaran $record) => Storage::url($record->kartu_keluarga), shouldOpenInNewTab: true),
                Tables\Actions\Action::make('download_foto')
                    ->label('Download Foto')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->url(fn(Pendaftaran $record) => Storage::url($record->pas_foto), shouldOpenInNewTab: true),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
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
}

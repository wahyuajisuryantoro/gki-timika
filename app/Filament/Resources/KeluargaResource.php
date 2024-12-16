<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KeluargaResource\Pages;
use App\Filament\Resources\KeluargaResource\RelationManagers;
use App\Models\Keluarga;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class KeluargaResource extends Resource
{
    protected static ?string $model = Keluarga::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $modelLabel = 'keluarga';
    protected static ?string $pluralModelLabel = 'keluarga';

    public static function form(Form $form): Form

    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nomor_induk_keluarga')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('nama_kepala_keluarga')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('alamat')
                    ->required()
                    ->maxLength(65535),
                Forms\Components\TextInput::make('kecamatan')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('kota')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('nomor_telepon')
                    ->tel()
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('jumlah_anggota')
                    ->required()
                    ->integer(),
                Forms\Components\Select::make('status_keluarga')
                    ->required()
                    ->options([
                        'aktif' => 'Aktif',
                        'tidak_aktif' => 'Tidak Aktif',
                    ]),
                Forms\Components\Textarea::make('catatan')
                    ->maxLength(65535),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nomor_induk_keluarga'),
                Tables\Columns\TextColumn::make('nama_kepala_keluarga'),
                Tables\Columns\TextColumn::make('kota'),
                Tables\Columns\TextColumn::make('jumlah_anggota'),
                Tables\Columns\BadgeColumn::make('status_keluarga')
                    ->colors([
                        'success' => 'aktif',
                        'danger' => 'tidak_aktif',
                    ]),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status_keluarga')
                    ->options([
                        'aktif' => 'Aktif',
                        'tidak_aktif' => 'Tidak Aktif',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListKeluargas::route('/'),
            'create' => Pages\CreateKeluarga::route('/create'),
            'edit' => Pages\EditKeluarga::route('/{record}/edit'),
        ];
    }
}

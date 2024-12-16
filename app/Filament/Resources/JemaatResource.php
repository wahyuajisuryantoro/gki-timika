<?php

namespace App\Filament\Resources;

use App\Filament\Resources\JemaatResource\Pages;
use App\Filament\Resources\JemaatResource\RelationManagers;
use App\Models\Jemaat;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class JemaatResource extends Resource
{
    protected static ?string $model = Jemaat::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';
    protected static ?string $modelLabel = 'jemaat';
    protected static ?string $pluralModelLabel = 'jemaat';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Forms\Components\Select::make('id_keluarga')
                ->relationship('keluarga', 'nama_kepala_keluarga')
                ->required(),
            Forms\Components\TextInput::make('nomor_induk_jemaat')
                ->disabled()
                ->dehydrated(false),
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
            Forms\Components\Select::make('status_pernikahan')
                ->options([
                    'belum_menikah' => 'Belum Menikah',
                    'menikah' => 'Menikah',
                    'cerai' => 'Cerai',
                    'duda' => 'Duda',
                    'janda' => 'Janda',
                ])
                ->required(),
            Forms\Components\Textarea::make('alamat_rumah')
                ->required()
                ->maxLength(65535),
            Forms\Components\TextInput::make('nomor_telepon')
                ->tel()
                ->maxLength(255),
            Forms\Components\TextInput::make('email')
                ->email()
                ->maxLength(255),
            Forms\Components\DatePicker::make('tanggal_baptis'),
            Forms\Components\DatePicker::make('tanggal_sidi'),
            Forms\Components\Select::make('status_keanggotaan')
                ->options([
                    'aktif' => 'Aktif',
                    'tidak_aktif' => 'Tidak Aktif',
                    'meninggal' => 'Meninggal',
                    'pindah' => 'Pindah',
                ])
                ->required(),
            Forms\Components\TextInput::make('pekerjaan')
                ->maxLength(255),
            Forms\Components\Textarea::make('catatan')
                ->maxLength(65535),
            Forms\Components\FileUpload::make('foto')
                ->image()
                ->directory('jemaat-photos'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            Tables\Columns\TextColumn::make('nomor_induk_jemaat'),
            Tables\Columns\TextColumn::make('nama_lengkap'),
            Tables\Columns\TextColumn::make('keluarga.nama_kepala_keluarga'),
            Tables\Columns\TextColumn::make('tanggal_lahir')
                ->date(),
            Tables\Columns\BadgeColumn::make('status_keanggotaan')
                ->colors([
                    'primary' => 'aktif',
                    'danger' => 'tidak_aktif',
                    'warning' => 'meninggal',
                    'secondary' => 'pindah',
                ]),
        ])
        ->filters([
            Tables\Filters\SelectFilter::make('status_keanggotaan')
                ->options([
                    'aktif' => 'Aktif',
                    'tidak_aktif' => 'Tidak Aktif',
                    'meninggal' => 'Meninggal',
                    'pindah' => 'Pindah',
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
            'index' => Pages\ListJemaats::route('/'),
            'create' => Pages\CreateJemaat::route('/create'),
            'edit' => Pages\EditJemaat::route('/{record}/edit'),
        ];
    }
}

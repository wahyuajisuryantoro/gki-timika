<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KebaktianResource\Pages;
use App\Filament\Resources\KebaktianResource\RelationManagers;
use App\Models\Kebaktian;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class KebaktianResource extends Resource
{
    protected static ?string $model = Kebaktian::class;

    protected static ?string $navigationIcon = 'heroicon-o-heart';
    protected static ?string $modelLabel = 'Kebaktian';
    protected static ?string $pluralModelLabel = 'Kebaktian';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('id_admin')
                    ->relationship('admin', 'username')
                    ->required(),
                Forms\Components\Select::make('id_anggota')
                    ->relationship('anggota', 'nama')
                    ->required(),
                Forms\Components\Select::make('jenis_kebaktian')
                    ->options([
                        'minggu' => 'Minggu',
                        'khusus' => 'Khusus',
                        'keluarga' => 'Keluarga',
                    ])
                    ->required(),
                Forms\Components\TextInput::make('nama_kebaktian')
                    ->required()
                    ->maxLength(255),
                Forms\Components\DatePicker::make('tanggal')
                    ->required(),
                Forms\Components\TimePicker::make('waktu_mulai')
                    ->required(),
                Forms\Components\TimePicker::make('waktu_selesai')
                    ->required(),
                Forms\Components\TextInput::make('lokasi')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('deskripsi')
                    ->maxLength(65535),
                Forms\Components\Select::make('status')
                    ->options([
                        'scheduled' => 'Scheduled',
                        'ongoing' => 'Ongoing',
                        'completed' => 'Completed',
                        'cancelled' => 'Cancelled',
                    ])
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('admin.username'),
                Tables\Columns\TextColumn::make('anggota.nama'),
                Tables\Columns\TextColumn::make('jenis_kebaktian'),
                Tables\Columns\TextColumn::make('nama_kebaktian'),
                Tables\Columns\TextColumn::make('tanggal')
                    ->date(),
                Tables\Columns\TextColumn::make('waktu_mulai')
                    ->time(),
                Tables\Columns\TextColumn::make('waktu_selesai')
                    ->time(),
                Tables\Columns\TextColumn::make('lokasi'),
                Tables\Columns\TextColumn::make('status'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('jenis_kebaktian')
                ->options([
                    'minggu' => 'Minggu',
                    'khusus' => 'Khusus',
                    'keluarga' => 'Keluarga',
                ]),
            Tables\Filters\SelectFilter::make('status')
                ->options([
                    'scheduled' => 'Scheduled',
                    'ongoing' => 'Ongoing',
                    'completed' => 'Completed',
                    'cancelled' => 'Cancelled',
                ]),
            Tables\Filters\Filter::make('tanggal')
                ->form([
                    Forms\Components\DatePicker::make('dari_tanggal'),
                    Forms\Components\DatePicker::make('sampai_tanggal'),
                ])
                ->query(function (Builder $query, array $data): Builder {
                    return $query
                        ->when(
                            $data['dari_tanggal'],
                            fn (Builder $query, $date): Builder => $query->whereDate('tanggal', '>=', $date),
                        )
                        ->when(
                            $data['sampai_tanggal'],
                            fn (Builder $query, $date): Builder => $query->whereDate('tanggal', '<=', $date),
                        );
                })
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListKebaktians::route('/'),
            'create' => Pages\CreateKebaktian::route('/create'),
            'edit' => Pages\EditKebaktian::route('/{record}/edit'),
        ];
    }
}

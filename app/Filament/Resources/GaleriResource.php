<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GaleriResource\Pages;
use App\Filament\Resources\GaleriResource\RelationManagers;
use App\Models\Galeri;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class GaleriResource extends Resource
{
    protected static ?string $model = Galeri::class;

    protected static ?string $navigationIcon = 'heroicon-o-photo';
    protected static ?string $modelLabel = 'galeri';
    protected static ?string $pluralModelLabel = 'galeri';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Forms\Components\TextInput::make('judul')
                ->required()
                ->maxLength(255),
            Forms\Components\TextInput::make('lokasi')
                ->required()
                ->maxLength(255),
            Forms\Components\FileUpload::make('gambar')
                ->image()
                ->required()
                ->maxSize(1024)
                ->directory('galeri'),
            Forms\Components\TextInput::make('urutan')
                ->integer()
                ->default(0),
            Forms\Components\Toggle::make('aktif')
                ->required()
                ->default(true),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('judul')->searchable(),
                Tables\Columns\TextColumn::make('lokasi')->searchable(),
                Tables\Columns\ImageColumn::make('gambar'),
                Tables\Columns\TextColumn::make('urutan'),
                Tables\Columns\BooleanColumn::make('aktif'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListGaleris::route('/'),
            'create' => Pages\CreateGaleri::route('/create'),
            'edit' => Pages\EditGaleri::route('/{record}/edit'),
        ];
    }
}

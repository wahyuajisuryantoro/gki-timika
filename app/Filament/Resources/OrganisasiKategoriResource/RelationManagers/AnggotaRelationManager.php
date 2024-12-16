<?php

namespace App\Filament\Resources\OrganisasiKategoriResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AnggotaRelationManager extends RelationManager
{
    protected static string $relationship = 'anggota';

    protected static ?string $recordTitleAttribute = 'nama';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('jabatan')
                    ->required()
                    ->maxLength(255),
                Forms\Components\FileUpload::make('foto')
                    ->image()
                    ->maxSize(5120)
                    ->directory('anggota-organisasi-photos'),
                Forms\Components\TextInput::make('urutan')
                    ->required()
                    ->integer(),
                Forms\Components\Toggle::make('status')
                    ->required(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama'),
                Tables\Columns\TextColumn::make('jabatan'),
                Tables\Columns\TextColumn::make('urutan'),
                Tables\Columns\BooleanColumn::make('status'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
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
}

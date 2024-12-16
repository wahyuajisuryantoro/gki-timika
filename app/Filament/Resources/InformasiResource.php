<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InformasiResource\Pages;
use App\Filament\Resources\InformasiResource\RelationManagers;
use App\Models\Informasi;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class InformasiResource extends Resource
{
    protected static ?string $model = Informasi::class;

    protected static ?string $navigationIcon = 'heroicon-o-information-circle';
    protected static ?string $modelLabel = 'informasi';
    protected static ?string $pluralModelLabel = 'informasi';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Forms\Components\Select::make('kategori')
                ->options([
                    'pengumuman' => 'Pengumuman',
                    'berita' => 'Berita',
                    'artikel' => 'Artikel',
                ])
                ->required(),
            Forms\Components\RichEditor::make('konten')
                ->required()
                ->columnSpan(2),
            Forms\Components\DatePicker::make('tanggal_diterbitkan')
                ->required(),
            Forms\Components\DatePicker::make('tanggal_kadaluarsa'),
            Forms\Components\FileUpload::make('gambar')
            ->image()
            ->directory('informasi-images')
            ->maxSize(10240)
            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/gif'])
            ->helperText('Ukuran maksimum file: 10MB. Format yang diterima: JPG, PNG, GIF.'),
            Forms\Components\TextInput::make('penulis')
                ->required(),
            Forms\Components\Select::make('status')
                ->options([
                    'draft' => 'Draft',
                    'published' => 'Published',
                    'archived' => 'Archived',
                ])
                ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('kategori'),
                Tables\Columns\TextColumn::make('tanggal_diterbitkan')
                    ->date(),
                Tables\Columns\TextColumn::make('penulis'),
                Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'secondary' => 'draft',
                        'success' => 'published',
                        'danger' => 'archived',
                    ]),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('kategori')
                ->options([
                    'pengumuman' => 'Pengumuman',
                    'berita' => 'Berita',
                    'artikel' => 'Artikel',
                ]),
            Tables\Filters\SelectFilter::make('status')
                ->options([
                    'draft' => 'Draft',
                    'published' => 'Published',
                    'archived' => 'Archived',
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
            'index' => Pages\ListInformasis::route('/'),
            'create' => Pages\CreateInformasi::route('/create'),
            'edit' => Pages\EditInformasi::route('/{record}/edit'),
        ];
    }
}

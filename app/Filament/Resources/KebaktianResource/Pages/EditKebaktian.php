<?php

namespace App\Filament\Resources\KebaktianResource\Pages;

use App\Filament\Resources\KebaktianResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditKebaktian extends EditRecord
{
    protected static string $resource = KebaktianResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

<?php

namespace App\Filament\Resources\OrganisasiKategoriResource\Pages;

use App\Filament\Resources\OrganisasiKategoriResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditOrganisasiKategori extends EditRecord
{
    protected static string $resource = OrganisasiKategoriResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

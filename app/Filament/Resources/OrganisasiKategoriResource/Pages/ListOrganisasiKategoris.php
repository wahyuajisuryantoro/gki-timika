<?php

namespace App\Filament\Resources\OrganisasiKategoriResource\Pages;

use App\Filament\Resources\OrganisasiKategoriResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListOrganisasiKategoris extends ListRecords
{
    protected static string $resource = OrganisasiKategoriResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

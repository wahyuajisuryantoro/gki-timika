<?php

namespace App\Filament\Resources\OrganisasiKategoriResource\Pages;

use App\Filament\Resources\OrganisasiKategoriResource;
use Filament\Pages\Actions\CreateAction;
use Filament\Pages\Page;
use Filament\Resources\Pages\ManageRecords;

class ManageAnggota extends ManageRecords
{
    protected static string $resource = OrganisasiKategoriResource::class;

    protected static ?string $title = 'Anggota Organisasi';

    protected static string $view = 'filament.pages.manage-anggota';

    protected function getActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
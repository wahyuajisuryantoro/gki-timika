<?php

namespace App\Filament\Widgets;

use App\Models\OrganisasiKategori;
use Filament\Widgets\Widget;

class JumlahOrganisasiKategoriWidget extends Widget
{
    protected static ?string $heading = 'Jumlah Organisasi';
    protected static string $view = 'filament.widgets.jumlah-organisasi-kategori-widget';
    public int $jumlahKategori;

    public function mount(): void
    {
        $this->jumlahKategori = OrganisasiKategori::count();
    }
}

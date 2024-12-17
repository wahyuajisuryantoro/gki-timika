<?php

namespace App\Filament\Widgets;

use App\Models\Keluarga;
use Filament\Widgets\Widget;

class JumlahKeluargaWidget extends Widget
{
    protected static ?string $heading = 'Jumlah Keluarga';
    protected static string $view = 'filament.widgets.jumlah-keluarga-widget';
    public int $jumlahKeluarga;

    public function mount(): void
    {
        $this->jumlahKeluarga = Keluarga::count();
    }
}

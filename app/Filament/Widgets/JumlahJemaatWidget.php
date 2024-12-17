<?php

namespace App\Filament\Widgets;

use App\Models\Jemaat;
use Filament\Widgets\Widget;

class JumlahJemaatWidget extends Widget
{
    protected static ?string $heading = 'Jumlah Jemaat';
    protected static string $view = 'filament.widgets.jumlah-jemaat-widget';

    public int $jumlahJemaat;

    public function mount(): void
    {
        $this->jumlahJemaat = Jemaat::count();
    }
}

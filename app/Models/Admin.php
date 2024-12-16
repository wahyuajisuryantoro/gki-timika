<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;

class Admin extends Authenticatable implements FilamentUser
{
    use Notifiable;

    protected $table = 'tbl_admin';
    protected $primaryKey = 'id_admin';

    protected $fillable = [
        'username', 'email', 'password',
    ];

    protected $hidden = [
        'password',
    ];

    public function canAccessPanel(Panel $panel): bool
    {
        return true;
    }

     /**
     * Accessor untuk atribut 'name'.
     * Mengembalikan nilai dari 'username' atau 'nama_lengkap'.
     *
     * @return string
     */
    public function getNameAttribute()
    {
        return $this->username;
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Roles extends Model // <-- Diubah dari 'Roles' menjadi 'Role'
{
    // Secara otomatis Laravel akan mencari tabel 'roles'
    use SoftDeletes;
    protected $fillable = [
        'name',
    ];

    // Perhatikan relasi ini, jika Model User juga ada di App\Models
    public function users()
    {
        return $this->hasMany(User::class, 'id_user');
    }
}

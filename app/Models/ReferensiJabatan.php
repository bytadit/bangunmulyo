<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ReferensiJabatan extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function pejabats(): HasMany
    {
        return $this->hasMany(PejabatBumdes::class, 'jabatan_id');
    }
    public function anggota(): HasMany
    {
        return $this->hasMany(AnggotaKelompok::class, 'jabatan_id');
    }
}

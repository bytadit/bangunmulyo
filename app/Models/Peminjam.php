<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Peminjam extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function anggota(): HasMany
    {
        return $this->hasMany(AnggotaKelompok::class, 'kelompok_id');
    }
    public function perorangan(): HasMany
    {
        return $this->hasMany(Perorangan::class, 'peminjam_id');
    }
    public function pinjaman(): HasMany
    {
        return $this->hasMany(Pinjaman::class, 'peminjam_id');
    }

}

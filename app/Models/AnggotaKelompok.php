<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;


class AnggotaKelompok extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $dates = ['tgl_lahir'];
    public function kelompok(): BelongsTo
    {
        return $this->belongsTo(Peminjam::class, 'kelompok_id');
    }
    public function jabatan(): BelongsTo
    {
        return $this->belongsTo(ReferensiJabatan::class, 'jabatan_id');
    }
    public function pinjamanAnggota(): HasMany
    {
        return $this->hasMany(PinjamanAnggota::class, 'anggota_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PinjamanAnggota extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function anggotaKelompok(): BelongsTo
    {
        return $this->belongsTo(AnggotaKelompok::class, 'anggota_id');
    }
    public function pinjamanKelompok(): BelongsTo
    {
        return $this->belongsTo(Pinjaman::class, 'pinjaman_id');
    }
}

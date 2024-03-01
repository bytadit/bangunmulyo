<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Pinjaman extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'pinjaman';
    protected $dates = ['tgl_pinjaman', 'tgl_jatuh_tempo', 'created_at', 'updated_at'];
    public function peminjam(): BelongsTo
    {
        return $this->belongsTo(Peminjam::class, 'peminjam_id');
    }
    public function pinjamanAnggota(): HasMany
    {
        return $this->hasMany(PinjamanAnggota::class, 'pinjaman_id');
    }
    public function angsuran(): HasMany
    {
        return $this->hasMany(Angsuran::class, 'pinjaman_id');
    }
}

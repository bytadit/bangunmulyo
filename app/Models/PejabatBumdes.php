<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\User;
use App\Models\ReferensiJabatan;

class PejabatBumdes extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function jabatan(): BelongsTo
    {
        return $this->belongsTo(ReferensiJabatan::class, 'jabatan_id');
    }
    // public function biayas(): HasMany
    // {
    //     return $this->hasMany(Biaya::class, 'id_penerimaan');
    // }
}

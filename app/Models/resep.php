<?php

namespace App\Models;

use App\Models\Regency;
use App\Models\Province;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class resep extends Model
{
    use HasFactory;

    protected $fillable = [
     'name',
     'slug',
     'province_id',
     'regency_id',
     'jenis_id',
     'category_id',
     'foto',
     'cara',
     'bahan',
     'catatan',
    ];

    protected $casts = [
     'foto' => 'array'
    ];

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    public function provinces(): BelongsTo
    {
        return $this->belongsTo(Province::class);
    }

    // public function regencies(): BelongsTo
    // {
    //     return $this->belongsTo(Regency::class);
    // }

    public function regencies() //regencies
    {
        return $this->hasMany(Regency::class);
    }

    public function jenis(): BelongsTo
    {
        return $this->belongsTo(Jenis::class);
    }

}

// https://filamentphp.com/plugins/hasnayeen-themes

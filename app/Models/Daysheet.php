<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Daysheet extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $casts = [
        'work_date' => 'datetime'
    ];

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function materials(): HasMany {
        return $this->hasMany(Material::class);
    }

    public function engineers(): HasMany {
        return $this->hasMany(Engineer::class);
    }

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }
}

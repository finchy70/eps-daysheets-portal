<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Engineer extends Model
{
    protected $guarded = [];

    public function daysheet(): BelongsTo {
        return $this->belongsTo(Daysheet::class);
    }

    public function role(): BelongsTo {
        return $this->belongsTo(Role::class);
    }
}

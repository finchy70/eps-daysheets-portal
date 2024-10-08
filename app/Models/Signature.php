<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Signature extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function daysheet(): BelongsTo{
        return $this->belongsTo(Daysheet::class);
    }
}

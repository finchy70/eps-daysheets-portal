<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Markup extends Model
{
    protected $guarded = [];

    protected $casts = ['valid_from' => 'date', 'valid_to' => 'date'];

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }
}

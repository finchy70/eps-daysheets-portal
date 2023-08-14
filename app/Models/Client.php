<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected  $fillable = ['client'];

    public function daysheets(): HasMany {
        return $this->hasMany(Daysheet::class);
    }
}

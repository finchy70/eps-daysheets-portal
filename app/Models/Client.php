<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Client extends Model
{
    use HasFactory;

    protected  $fillable = ['client'];

    public function daysheets(): HasMany {
        return $this->hasMany(Daysheet::class);
    }

    public function mileages(): HasMany {
        return $this->hasMany(Mileage::class)->orderBy('id', 'desc');
    }
    public function currentMileageRate(): HasOne {
        return $this->hasOne(Mileage::class)
            ->where('valid_from', '<', now())
            ->where(function (Builder $query) {
                return $query->where('valid_to', '>', now())->orWhere('valid_to', null);
            });
    }
}

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

    protected  $fillable = ['client', 'markup'];

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


    public function mileageRateAtDate($date): HasOne
    {
        return $this->hasOne(Mileage::class)
            ->where('valid_from', '<', $date)
            ->where(function (Builder $query) use ($date) {
                return $query->where('valid_to', '>', $date)->orWhere('valid_to', null);
            });
    }

    public function currentRates(): HasOne
    {
        return $this->hasOne(Rate::class)
            ->where('valid_from', '<', now())
            ->where(function (Builder $q) {
                return $q->where('valid_to', '>=', now())->orWhere('valid_to', null);
            });

    }

    public function rateFromDate($date, $clientId, $roleId): HasOne
    {
        return $this->hasOne(Rate::class)
            ->where('client_id', $clientId)
            ->where('role_id', $roleId)
            ->where('valid_from', '<', $date)
            ->where(function (Builder $q) use ($date) {
                return $q->where('valid_to', '>=', $date)->orWhere('valid_to', null);
            });
    }

    public function getMileageRateFromDate($date, $clientId): HasOne
    {
        return $this->hasOne(Mileage::class)
            ->where('client_id', $clientId)
            ->where('valid_from', '<', $date)
            ->where(function (Builder $q) use ($date) {
                return $q->where('valid_to', '>=', $date)->orWhere('valid_to', null);
            });
    }
    public function rates(): HasMany
    {
        return $this->hasMany(Rate::class);
    }
}

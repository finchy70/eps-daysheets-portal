<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

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

    public function hotels(): HasMany {
        return $this->hasMany(Hotel::class);
    }

    public function engineers(): HasMany {
        return $this->hasMany(Engineer::class);
    }

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }

    public static function getMileageRate($date, $client_id): float
    {
        return Mileage::query()->where('client_id', $client_id)
            ->where('valid_from', '<', $date)
            ->where(function (Builder $q) use ($date) {
            return $q->where('valid_to', '>', $date) ->orWhere('valid_to', null);
        })
            ->first()->rate;
    }

    public function signature(): HasOne{
        return $this->hasOne(Signature::class);
    }
}

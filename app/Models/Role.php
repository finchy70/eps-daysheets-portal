<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Builder;

class Role extends Model
{
    protected $guarded = [];

    public function engineers(): HasMany {
        return $this->hasMany(Engineer::class);
    }

    public function getRateByDate($startDate, $roleId, $clientId): HasOne
    {
        return $this->hasOne(Rate::class)
            ->where('role_id', $roleId)
            ->where('client_id', $clientId)
            ->where('valid_from', '<', $startDate)
            ->where(function (Builder $q) use($startDate) {
                return $q->where('valid_to', '>=', $startDate)
                    ->orWhere('valid_to', null);
            });
    }
}

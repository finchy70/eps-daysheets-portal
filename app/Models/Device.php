<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\Device
 *
 * @property int $id
 * @property string $device_identifier
 * @property string|null $last_data_sync
 * @property string|null $last_inspection_sync
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Device newModelQuery()
 * @method static Builder|Device newQuery()
 * @method static Builder|Device query()
 * @method static Builder|Device whereCreatedAt($value)
 * @method static Builder|Device whereDeviceIdentifier($value)
 * @method static Builder|Device whereId($value)
 * @method static Builder|Device whereLastDataSync($value)
 * @method static Builder|Device whereLastInspectionSync($value)
 * @method static Builder|Device whereUpdatedAt($value)
 * @mixin Eloquent
 */
class Device extends Model
{
    use HasFactory;
}

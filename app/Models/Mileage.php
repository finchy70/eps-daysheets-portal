<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mileage extends Model
{
    use HasFactory;

    protected $casts = ['valid_from' => 'date', 'valid_to' => 'date'];

    protected $fillable = ['client_id', 'rate', 'valid_from', 'valid_to'];
}

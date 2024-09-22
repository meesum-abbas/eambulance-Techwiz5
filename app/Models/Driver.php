<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    use HasFactory;

    protected $fillable = [
        'driver_name',
        'driver_license_no',
        'driver_address',
        'driver_phone',
        'username',
        'email',
        'password',
        'driver_image',
        'latitude',
        'longitude',
    ];
}

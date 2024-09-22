<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class emergency_request extends Model
{
    use HasFactory;

    protected $fillable = [
        'hospital_name', 
        'mobile_no', 
        'address', 
        'pickup_address', 
        'latitude', 
        'longitude', 
        'type',
    ];
    

    public function driver()
    {
        return $this->belongsTo(User::class, 'driver_id');
    }
}

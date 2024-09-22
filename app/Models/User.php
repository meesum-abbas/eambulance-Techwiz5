<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Http\Controllers\EmergencyRequestController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'rolefk',
        'image',
        'username',
        'driver_license_no',
        'driver_address',
        'driver_phone',
        'driver_image',
        'latitude',
        'longitude',
        'ambulance_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'date_of_birth' => 'date',
        ];
    }

    public static $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users|max:255',
        'password' => 'required|string|min:8',
        'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
    ];

    public function emergencyRequests()
    {
        return $this->hasMany(EmergencyRequestController::class, 'driver_id');
    }



    public static $updateRules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'password' => 'nullable|string|min:8',
        'rolefk' => 'required|exists:roles,id',
    ];


    public function roles()
    {
        return $this->hasOne(Roles::class,'id', 'rolefk');
    }

    public function ambulance()
    {
        return $this->belongsTo(Ambulance::class);
    }
}

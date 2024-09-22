<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ambulance extends Model
{
    use HasFactory;
    protected $fillable = [
        'type',
        'equipment',
        'cost',
        'size',
        'image',
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'ambulance_id');
    }
}

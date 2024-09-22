<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalCard extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 
        'medical_history',
        'allergies',
        'name',
        'relation',
        'contact_no'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consult extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'appointment_date_time',
        'patient_id'
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

}

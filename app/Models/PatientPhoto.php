<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientPhoto extends Model
{
    use HasFactory;

    protected $table = 'patients_photos';

    protected $fillable = [
        'description',
        'photo_before',
        'photo_after',
        'data_photo_before',
        'data_photo_after',
        'patient_id'
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}

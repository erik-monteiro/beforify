<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;

    protected $fillable = [
        'exam',
        'description',
        'file_path',
        'patient_id'
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}





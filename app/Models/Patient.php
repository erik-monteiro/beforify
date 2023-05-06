<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'lastname',
        'email',
        'gender',
        'birth_date',
        'photo',
        'procedure_type'
    ];

    public function exams()
    {
        return $this->hasMany(Exam::class);
    }

    public function consults()
    {
        return $this->hasMany(Consult::class);
    }

    public function photos()
    {
        return $this->hasMany(PatientPhoto::class);
    }
}

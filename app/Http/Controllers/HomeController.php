<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\Consult;
use App\Models\Exam;

class HomeController extends Controller
{
    public function home()
    {
        $numberOfPatients = count(Patient::get());
        $numberOfConsults = count(Consult::get());
        return view('home', compact('numberOfPatients', 'numberOfConsults'));
    }
}

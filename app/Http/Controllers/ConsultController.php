<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Consult;
use App\Models\Patient;
use Illuminate\Support\Facades\DB;

class ConsultController extends Controller
{
    public function index()
    {
        $consults = Consult::all();
        $day = date('d');
        $year = date('Y');
        $month = date('m');
        $monthF = date('F');
        $dateFormat = array($year, $month, $day);
        $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        $months = [
            'January' => 'Janeiro', 
            'February' => 'Fevereiro', 
            'March' => 'Março', 
            'April' => 'Abril', 
            'May' => 'Maio',
            'June' => 'Junho', 
            'July' => 'Julho', 
            'August' => 'Agosto', 
            'September' => 'Setembro',   
            'October' => 'Outubro', 
            'November' => 'Novembro', 
            'December' => 'Dezembro'
        ];
        $monthString = "";
        foreach ($months as $key => $value) {
            if ($key == $monthF) {
                $monthString .= $value;
            }
        }

        return view('consults.index', compact('consults', 'year', 'day', 'monthString', 'daysInMonth', 'month', 'dateFormat'));
    }

    public function create()
    {
        $patients = Patient::pluck('name', 'id');
        return view('consults.create', compact('patients'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'patient_id' => 'required',
            'description' => 'required',
            'appointment_date_time' => 'required'
        ]);

        Consult::create($request->all());

        return redirect()->route('consults.index')->with('success', 'Consulta agendada com sucesso!');
    }

    public function edit(Consult $consult)
    {
        $patients = Patient::pluck('name', 'id');
        return view('consults.edit', compact('consult', 'patients'));
    }

    public function update(Request $request, Consult $consult)
    {
        $consult->update($request->all());
        return redirect()->route('consults.show', substr($consult->appointment_date_time, 0, 10))
                ->with('info', 'Consulta editada!');
    }

    public function destroy(Consult $consult)
    {
        $consult->delete();
        return redirect()->route('consults.show', substr($consult->appointment_date_time, 0, 10))
            ->with('danger', 'Consulta cancelada!');
    }


    public function show($appointment_date_time)
    {
        $consults = Consult::where(DB::raw('DATE(appointment_date_time)'), '=', substr($appointment_date_time, 0, 10))->get();
        return view('consults.show', compact('consults', 'appointment_date_time'));
    }


}

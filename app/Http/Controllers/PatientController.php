<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;

class PatientController extends Controller
{
    public function index()
    {
        $patients = Patient::orderBy('id', 'desc')->paginate(5);

        return view('patients.index', compact('patients'))
                    ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        return view('patients.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'lastname' => 'required',
            'email' => 'required|email',
            'gender' => 'required',
            'birth_date' => 'required|date',
            'procedure_type' => 'required',
        ]);

        if (!empty($request->photo)) {
            $path = (new UploadFileController())->storeFile($request, 'assets/img/profile-pictures/', 'photo');
        } else {
            if ($request->gender == 'masculino') {
                $path = 'assets/img/profile-pictures/male-photo.png';
            } else if ($request->gender == 'feminino') {
                $path = 'assets/img/profile-pictures/female-photo.png';
            } else {
                $path = 'assets/img/profile-pictures/no-profile-picture.png';
            }
        }

        $patient = new Patient([
            'name' => $request->get('name'),
            'lastname' => $request->get('lastname'),
            'email' => $request->get('email'),
            'gender' => $request->get('gender'),
            'birth_date' => $request->get('birth_date'),
            'procedure_type' => $request->get('procedure_type'),
            'photo' => $path
        ]);
        $patient->save();

        return redirect()->route('patients.index')
                 ->with('success', 'Paciente adicionado com sucesso!');
    }


    public function edit(Patient $patient) 
    {
        return view('patients.edit', compact('patient'));
    }

    public function update(Request $request, Patient $patient)
    {
        if (!empty($request->photo)) {
            $path = (new UploadFileController())->storeFile($request, 'assets/img/profile-pictures/', 'photo');
        } else {
            $path = $patient->photo;
        }

        $patient->name = $request->get('name');
        $patient->lastname = $request->get('lastname');
        $patient->email = $request->get('email');
        $patient->gender = $request->get('gender');
        $patient->birth_date = $request->get('birth_date');
        $patient->procedure_type = $request->get('procedure_type');
        $patient->photo = $path;
        $patient->save();

        return redirect()->route('patients.index')
                ->with('info', 'Paciente editado com sucesso!');
    }


    public function destroy(Patient $patient)
    {
        $patient->delete();

        return redirect()->route('patients.index')
                ->with('danger', 'Paciente excluído com sucesso!');
    }

    public function show(Patient $patient)
    {
        return view('patients.show', compact('patient'));
    }

}

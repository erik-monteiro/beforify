<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Exam;
use App\Models\Patient;
use Illuminate\Http\UploadedFile;

class ExamController extends Controller
{
    public function index(Patient $patient)
    {
        $exams = Exam::latest()->get();
        $patient = Exam::where('patient_id', $patient->id)->get();
        return view('exams.index', compact('exams', 'patient'));
    }

    public function create()
    {
        return view('exams.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'exam' => 'required',
            'description',
            'file_path' => 'required',
            'patient_id' => 'required'
        ]);

        if (!empty($request->file_path)) {
            $path = (new UploadFileController())->storeFile($request, 'assets/img/exams-files/', 'file_path');
        } 

        $patient_id = $request->patient_id;
        $exam = new Exam([
            'exam' => $request->exam,
            'description' => $request->description,
            'file_path' => $path,
            'patient_id' => $request->patient_id
        ]);
        $exam->save();
    
        return redirect()->route('exams.index', compact('patient_id'))
                    ->with('success', 'Exame adicionado com sucesso!');
    }

    public function edit(Exam $exam)
    {
        return view('exams.edit', compact('exam'));
    }

    public function update(Request $request, Exam $exam)
    {
        if (!empty($request->file_path)) {
            $path = (new UploadFileController())->storeFile($request, 'assets/img/exams-files/', 'file_path');
        } else {
            $path = $exam->file_path;
        }
        
        $exam->exam = $request->get('exam');
        $exam->description = $request->get('description');
        $exam->file_path = $path;
        $exam->patient_id = $request->get('patient_id');
        $exam->save();

        return redirect()->route('exams.index')->with('info', 'Exame editado com sucesso!');
    }

    public function destroy(Exam $exam)
    {
        $patient_id = $exam->patient_id;
        $exam->delete();

        return redirect()->route('exams.index', compact('patient_id'))->with('danger', 'Exame excluído com sucesso!');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\PatientPhoto;
use Illuminate\Http\UploadedFile;

class PatientPhotoController extends Controller
{
    public function index($patient_id)
    {
        $patient = Patient::findOrFail($patient_id);
        $photos = $patient->photos()->latest()->get();

        return view('patientsPhotos.index', compact('photos', 'patient'));
    }

    public function create($patient_id)
    {
        $patient = Patient::findOrFail($patient_id);
        return view('patientsPhotos.create', compact('patient'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'data_photo_before' => 'required',
            'data_photo_after' => 'required',
            'photo_before' => 'required',
            'photo_after' => 'required',
            'patient_id' => 'required'
        ]);

        if (!empty($request->photo_before) && !empty($request->photo_after)) {
            $photo_before = (new UploadFileController())->storeFile($request, 'assets/img/photos-before-after/', 'photo_before');
            $photo_after = (new UploadFileController())->storeFile($request, 'assets/img/photos-before-after/', 'photo_after');
        }

        $patient_id = $request->patient_id;
        $photo = new PatientPhoto([
            'description' => $request->description,
            'data_photo_before' => $request->data_photo_before,
            'data_photo_after' => $request->data_photo_after,
            'photo_before' => $photo_before,
            'photo_after' => $photo_after,
            'patient_id' => $patient_id
        ]);        
        $photo->save();

        return redirect()->route('patientsPhotos.index', compact('patient_id'))
                        ->with('success', 'Fotos adicionadas com sucesso!');
    }

    public function destroy(PatientPhoto $photo)
    {
        $patient_id = $photo->patient_id;
        $photo->delete();

        return redirect()->route('patientsPhotos.index', compact('patient_id'))->with('danger', 'Fotos excluídas com sucesso!');
    }
}

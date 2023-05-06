<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\ConsultController;
use App\Http\Controllers\PatientPhotoController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'home'])->name('home');

Route::resource('patients', PatientController::class);

// praticando outro tipo de declaração de rotas
Route::get('/exams/{patient_id}', [ExamController::class, 'index'])->name('exams.index');
Route::get('/exams/create/{patient_id}', function ($patient_id) {
    return view('exams.create', ['patient_id' => $patient_id]);
})->name('exams.create');
Route::post('/exams/store', [ExamController::class, 'store'])->name('exams.store');
Route::get('/exams/{exam}/edit', [ExamController::class, 'edit'])->name('exams.edit');
Route::get('/exams/edit/{exam}', function($exam) {
    return view('exams.edit', ['exam' => $exam]);
})->name('exams.edit');
Route::post('/exams/update/{exam}', [ExamController::class, 'update'])->name('exams.update');
Route::delete('/exams/{exam}', [ExamController::class, 'destroy'])->name('exams.destroy');

Route::resource('consults', ConsultController::class);

Route::get('/patientsPhotos/{patient_id}', [PatientPhotoController::class, 'index'])->name('patientsPhotos.index');
Route::get('/patientsPhotos/create/{patient_id}', [PatientPhotoController::class, 'create'])->name('patientsPhotos.create');
Route::post('/patientsPhotos/store', [PatientPhotoController::class, 'store'])->name('patientsPhotos.store');
Route::delete('/patientsPhotos/{photo}', [PatientPhotoController::class, 'destroy'])->name('patientsPhotos.destroy');

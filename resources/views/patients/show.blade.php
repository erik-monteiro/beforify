@extends('includes.layout')

@section('content')
<div class="container-fluid p-4 shadow mx-auto" style="max-width: 1000px;">
    <h3 class="text-center mb-4">Informações completas do paciente <strong>{{ $patient->name }}</strong></h3>

    <div class="row">
        <div class="col-sm-4 col-md-3">
            <img src="{{ asset('assets/img/profile-pictures/' . substr($patient->photo, 28)) }}" class="border border-primary d-block mx-auto rounded-circle h-50" style="width: 170px;">
            <h3 class="text-center mt-2">{{ $patient->name }}</h3>
            <br>
        </div>
        
        <div class="col-sm-8 col-md-9 bg-light p-2">
            <table class="table table-hover table-striped table-bordered">
                <tr><th>Nome:</th><td>{{ $patient->name }}</td></tr>
                <tr><th>Sobrenome:</th><td>{{ $patient->lastname }}</td></tr>
                <tr><th>Email:</th><td>{{ $patient->email }}</td></tr>
                <tr><th>Gênero:</th><td>{{ $patient->gender }}</td></tr>
                <tr><th>Data de entrada:</th><td>{{ date_format($patient->created_at, 'd/m/Y') }}</td></tr>
                <tr><th>Data de nascimento:</th><td>{{ date('d/m/Y', strtotime($patient->birth_date)) }}</td></tr>
                <tr><th>Tipo de procedimento:</th><td>{{ $patient->procedure_type }}</td></tr>
            </table>
        </div>

        <div class="container text-center">
            <a href="{{ route('exams.create', ['patient_id' => $patient->id]) }}" class="btn btn-primary mt-4">Adicionar novo exame</a>
            <a href="{{ route('patientsPhotos.create', $patient->id) }}" class="btn btn-primary mt-4">Adicionar fotos de antes e depois</a>
        </div>
    </div>
    <br>
    <hr>
    <div class="container-fluid mb-5">
        <div class="row">
            <ul class="nav nav-tabs">
                <li class="nav-item col-sm-12 col-lg-3">
                    <a class="nav-link active" href="#" style="color: blue">Informações básicas</a>
                </li>
                <li class="nav-item col-sm-12 col-lg-3">
                    <a class="nav-link active" href="{{ route('exams.index', $patient->id) }}">Exames</a>
                    <ul class="nav nav-tabs">
                        @foreach ($patient->exams as $exam)            
                            <li class="nav-item col-sm-12 col-lg-12 nav-link">{{ substr($exam->file_path, 23) }}</li>               
                        @endforeach
                        @if (count($patient->exams) == 0)
                            <div class="container text-center">
                                <p class="p-2 text-center mt-2 mb-2">Nenhum exame cadastrado ainda!  
                                    <a style="color: blue;" href="{{ route('exams.create', $patient->id) }}">Clique aqui</a> para incluir um registro
                                </p>
                            </div>
                        @endif
                    </ul>
                </li>

                <li class="nav-item col-sm-12 col-lg-3">
                    <a href="#" class="nav-link active">Consultas</a>
                    <ul class="nav nav-tabs">
                        @foreach ($patient->consults as $consult)            
                            <li class="nav-item col-sm-12 col-lg-12 nav-link">{{ date('d/m/Y H:i', strtotime($consult->appointment_date_time)) }}</li>               
                        @endforeach
                        @if (count($patient->consults) == 0)
                            <div class="container text-center">
                                <p class="p-2 text-center mt-2 mb-2">Nenhuma consulta marcada ainda!
                                    <a style="color: blue;" href="{{ route('consults.create', $patient->id) }}">Clique aqui</a> para incluir um registro
                                </p>
                            </div>
                        @endif
                    </ul>
                </li>

                <li class="nav-item col-sm-12 col-lg-3">
                        <a href="#" class="nav-link active">Fotos de antes e depois</a>
                        <ul class="nav nav-tabs">
                            @if (count($patient->photos) == 0)
                                <div class="container text-center">
                                    <p class="p-2 text-center mt-2 mb-2">Nenhuma foto adicionada ainda!
                                        <a style="color: blue;" href="">Clique aqui</a> para incluir um registro
                                    </p>
                                </div>
                            @else 
                                <div class="container text-center">
                                    <a href="{{ route('patientsPhotos.index', $patient->id) }}" class="btn btn-sm btn-secondary mb-2 mt-4">Ver fotos</a>
                                </div> 
                            @endif 
                        </ul>
                </li>
            </ul>
        </div>
    </div>
@endsection
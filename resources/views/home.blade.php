@extends('includes.layout')

@section('content')

<div class="container text-center">
    <div class="row mt-5">
        <div class="col">
            <div class="card" style="width: 100%;">
                <div class="card-body">
                    <h5 class="card-title" style="font-size: 25px;">Número de pacientes cadastrados</h5>
                    <p class="card-text mt-4">Há um total de <b>{{ $numberOfPatients }}</b> pacientes cadastrados!</p>
                    <a href="{{ route('patients.create') }}" class="btn btn-sm btn-outline-primary radius-15 mt-4">Cadastrar um paciente</a>
                </div>
            </div>
        </div>
        
        <div class="col">
            <div class="card" style="width: 100%;">
                <div class="card-body">
                    <h5 class="card-title" style="font-size: 25px;">Número de consultas marcadas </h5>
                    <p class="card-text mt-4">Há um total de <b>{{ $numberOfConsults }}</b> consultas marcadas!</p>
                    <a href="{{ route('consults.create') }}" class="btn btn-sm btn-outline-primary radius-15 mt-4">Marque uma consulta</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
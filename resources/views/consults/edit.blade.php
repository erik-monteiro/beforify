@extends('includes.layout')

@section('content')

    <div class="container-fluid p-4 shadow mx-auto" style="max-width: 1000px;">
    
        <h3 class="text-center">Editar consulta</h3>
            
        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Erro!</strong>Verifique o que você digitou.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <form action="{{ route('consults.update', $consult->id) }}" method="POST" class="p-2" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="" class="form-label">Nome do paciente</label>
                <select name="patient_id" class="form-control">
                    @foreach ($patients as $id => $name)
                        <option value="{{ $id }}" {{ $consult->patient_id == $id ? 'selected' : '' }}>{{ $name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="" class="form-label">Descrição</label>
                <input type="text" name="description" class="form-control mb-3" value="{{ $consult->description }}">
            </div>
            
            <div class="mb-3">
                <label for="" class="form-label">Data da consulta</label>
                <input type="datetime-local" name="appointment_date_time" class="form-control mb-3" value="{{ $consult->appointment_date_time }}">
            </div>      

            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary mt-2">Editar</button>
            </div>
        </form>
    </div>

@endsection
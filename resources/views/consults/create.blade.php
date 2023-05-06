@extends('includes.layout')

@section('content')

    <div class="container-fluid p-4 shadow mx-auto" style="max-width: 1000px;">
    
        <h3 class="text-center">Marcar uma consulta</h3>
            
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
        
        
        <form action="{{ route('consults.store') }}" method="POST" class="p-2">
            @csrf

            <div class="mb-3">
                <label for="" class="form-label">Nome do paciente</label>
                <select name="patient_id" class="form-control">
                    @foreach($patients as $id => $name)
                        <option value="{{ $id }}">{{ $name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="" class="form-label">Descrição</label>
                <input type="text" name="description" class="form-control mb-3" placeholder="Descrição da consulta" required>
            </div>
            
            <div class="mb-3">
                <label for="" class="form-label">Data da consulta</label>
                <input type="datetime-local" name="appointment_date_time" class="form-control mb-3" required>
            </div>      

            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary mt-2">Adicionar</button>
            </div>
        </form>
    </div>

@endsection
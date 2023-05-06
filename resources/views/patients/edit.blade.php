@extends('includes.layout')
 
@section('content')
<div class="container-fluid p-4 shadow mx-auto" style="max-width: 1000px;">
  
    <h3 class="text-center">Editar paciente</h3>
         
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
    
    
    <form action="{{ route('patients.update', $patient->id) }}" method="POST" class="p-2" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="" class="form-label">Nome</label>
            <input type="text" name="name" class="form-control mb-3" placeholder="Nome" value="{{ $patient->name }}">
        </div>

        <div class="mb-3">
            <label for="" class="form-label">Sobrenome</label>
            <input type="text" name="lastname" class="form-control mb-3" placeholder="Sobrenome" value="{{ $patient->lastname }}">
        </div>

        <div class="mb-3">
            <label for="" class="form-label">Email</label>
            <input type="email" name="email" class="form-control mb-3" placeholder="Email" value="{{ $patient->email }}">
        </div>

        <div class="mb-3">   
            <label for="" class="form-label">Gênero</label>
            <select name="gender" class="form-control mb-3" required>
                <option value="">Selecione</option>
                <option value="masculino" {{ $patient->gender == 'masculino' ? 'selected' : '' }}>Masculino</option>
                <option value="feminino" {{ $patient->gender == 'feminino' ? 'selected' : '' }}>Feminino</option>
                <option value="outro" {{ $patient->gender == 'outro' ? 'selected' : '' }}>Outro</option>
            </select>   
        </div>

        <div class="mb-3">
            <label for="" class="form-label">Data de nascimento</label>
            <input type="date" class="form-control mb-3" name="birth_date" value="{{ $patient->birth_date }}">
        </div>

        <div class="mb-3">
            <label for="photo">Foto</label>
            <input type="file" name="photo" class="form-control" value="{{ $patient->photo }}">
            @if ($patient->photo)
                <img src="{{ asset($patient->photo) }}" alt="Foto do paciente" width="100">
            @else
                <span class="text-muted">Sem foto</span>
            @endif
        </div>

        <div class="mb-3">
            <label for="" class="form-label">Tipo de procedimento:</label>
            <input type="text" class="form-control mb-3" name="procedure_type" value="{{ $patient->procedure_type }}">
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary mt-2">Editar</button>
        </div>
    </form>
</div>
@endsection
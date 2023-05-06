@extends('includes.layout')
 
@section('content')
<div class="container-fluid p-4 shadow mx-auto" style="max-width: 1000px;">
  
    <h3 class="text-center">Adicionar novo paciente</h3>
         
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
    
    
    <form action="{{ route('patients.store') }}" method="POST" class="p-2" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="" class="form-label">Nome</label>
            <input type="text" name="name" class="form-control mb-3" placeholder="Nome" required>
        </div>

        <div class="mb-3">
            <label for="" class="form-label">Sobrenome</label>
            <input type="text" name="lastname" class="form-control mb-3" placeholder="Sobrenome" required>
        </div>

        <div class="mb-3">
            <label for="" class="form-label">Email</label>
            <input type="email" name="email" class="form-control mb-3" placeholder="Email" required>
        </div>

        <div class="mb-3">   
            <label for="" class="form-label">Gênero</label>
            <select name="gender" class="form-control mb-3" required>
                <option value="masculino">Masculino</option>
                <option value="feminino">Feminino</option>
                <option value="outro">Outro</option>
            </select>   
        </div>
        
        <div class="mb-3">
            <label for="" class="form-label">Data de nascimento</label>
            <input type="date" class="form-control mb-3" name="birth_date" required>
        </div>

        <div class="mb-3">
            <label for="" class="form-label">Foto de perfil</label>
            <input type="file" class="form-control mb-3" name="photo">
        </div>

        <div class="mb-3">
            <label for="" class="form-label">Tipo de procedimento:</label>
            <input type="text" class="form-control mb-3" name="procedure_type" required>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary mt-2">Adicionar</button>
        </div>
    </form>
</div>
@endsection
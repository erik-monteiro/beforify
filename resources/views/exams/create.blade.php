@extends('includes.layout')

@section('content')

    <div class="container-fluid p-4 shadow mx-auto" style="max-width: 1000px;">
    
        <h3 class="text-center">Adicionar novo exame</h3>
            
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
        
        
        <form action="{{ route('exams.store') }}" method="POST" class="p-2" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="" class="form-label">Exame</label>
                <input type="text" name="exam" class="form-control mb-3" placeholder="Tipo de exame" required>
            </div>

            <div class="mb-3">
                <label for="" class="form-label">Descrição</label>
                <input type="text" name="description" class="form-control mb-3" placeholder="Descrição">
            </div>    
            
            <div class="mb-3">
                <label for="" class="form-label">Arquivo</label>
                <input type="file" name="file_path" class="form-control mb-3" required>
            </div>      

            <input type="hidden" name="patient_id" value="{{ $patient_id }}">

            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary mt-2">Adicionar</button>
            </div>
        </form>
    </div>

@endsection
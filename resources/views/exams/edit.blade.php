@extends('includes.layout')

@section('content')

    <div class="container-fluid p-4 shadow mx-auto" style="max-width: 1000px;">
    
        <h3 class="text-center">Editar exame</h3>
            
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
        
        
        <form action="{{ route('exams.update', $exam->id) }}" method="POST" class="p-2" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="" class="form-label">Exame</label>
                <input type="text" name="exam" class="form-control mb-3" placeholder="Tipo de exame" value="{{ $exam->exam }}">
            </div>

            <div class="mb-3">
                <label for="" class="form-label">Descrição</label>
                <input type="text" name="description" class="form-control mb-3" placeholder="Descrição" value="{{ $exam->description }}">
            </div>    
            
            <div class="mb-3">
                <label for="" class="form-label">Arquivo</label>
                <input type="file" name="file_path" class="form-control mb-3" value="{{ $exam->file_path }}">
            </div>      

            <input type="hidden" name="patient_id" value="{{ $patient_id }}">

            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary mt-2">Editar</button>
            </div>
        </form>
    </div>

@endsection
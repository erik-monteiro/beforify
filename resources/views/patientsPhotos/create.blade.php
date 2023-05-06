@extends('includes.layout')

@section('content')

    <div class="container-fluid p-4 shadow mx-auto" style="max-width: 1000px;">
    
        <h3 class="text-center">Adicionar nova foto</h3>
            
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
        
        
        <form action="{{ route('patientsPhotos.store') }}" method="POST" class="p-2" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="" class="form-label">Descrição</label>
                <input type="text" name="description" class="form-control mb-3" placeholder="Descrição das fotos">
            </div>
            
            <div class="mb-3">
                <label for="" class="form-label">Data da foto de antes</label>
                <input type="date" name="data_photo_before" class="form-control mb-3" required>
            </div>    
            
            <div class="mb-3">
                <label for="" class="form-label">Data da foto de depois</label>
                <input type="date" name="data_photo_after" class="form-control mb-3" required>
            </div>      

            <div class="mb-3">
                <label for="" class="form-label">Foto de antes</label>
                <input type="file" name="photo_before" class="form-control mb-3" required>
            </div>      

            <div class="mb-3">
                <label for="" class="form-label">Foto de depois</label>
                <input type="file" name="photo_after" class="form-control mb-3" required>
            </div>      

            <input type="hidden" name="patient_id" value="{{ $patient->id }}">

            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary mt-2">Adicionar</button>
            </div>
        </form>
    </div>

@endsection
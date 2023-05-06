@extends('includes.layout')
 
@section('content')
    <div class="container-fluid p-4 shadow mx-auto" style="max-width: 1000px;">  
        <div class="container text-center">
            <h3 class="mb-3">Paciente: {{ $patient->name }}</h3>

            @if ($message = Session::get('success'))
                <div class="alert alert-success text-center">
                    <p>{{ $message }}</p>
                </div>
            @endif

            @if ($message = Session::get('danger'))
                <div class="alert alert-danger text-center">
                    <p>{{ $message }}</p>
                </div>
            @endif

            @foreach ($photos as $photo)
            <div class="row row-cols-1 row-cols-md-2 g-4 mb-4">
                <div class="col">
                    <div class="card">
                        <img src="{{ asset('assets/img/photos-before-after/' . substr($photo->photo_before, 31)) }}" class="img-fluid" style="object-fit: fill; width: 100%; height: 300px;">
                        <div class="card-body">
                            @if (!empty($photo->description))
                                <p><b>{{ $photo->description }}</b></p>
                            @else
                                <p><b>Sem descrição</b></p>
                            @endif
                        </div>
                        <div class="card-footer">
                            <small class="text-body-secondary">Foto de {{ date('d/m/Y', strtotime($photo->data_photo_before)) }}</small>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card" style="object-fit: cover;">
                        <img src="{{ asset('assets/img/photos-before-after/' . substr($photo->photo_after, 31)) }}" class="img-fluid" style="object-fit: fill; width: 100%; height: 300px;">
                        <div class="card-body">
                            @if (!empty($photo->description))
                                <p><b>{{ $photo->description }}</b></p>
                            @else
                                <p><b>Sem descrição</b></p>
                            @endif
                        </div>
                        <div class="card-footer">
                            <small class="text-body-secondary">Foto de {{ date('d/m/Y', strtotime($photo->data_photo_after)) }}</small>
                        </div>
                    </div>
                </div>

                <div class="container text-center">
                    <form action="{{ route('patientsPhotos.destroy', $photo->id) }}" method="POST">  
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm float-right">Excluir</button>
                    </form>
                </div>
            </div>
            @endforeach

            <a href="{{ route('patientsPhotos.create', ['patient_id' => $patient->id]) }}" class="btn btn-primary">Adicionar nova foto</a>
        </div>
    </div>
@endsection
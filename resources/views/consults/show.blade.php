@extends('includes.layout')

@section('content')


<h3 class="text-center mb-4">Todas consultas do dia <b>{{ date('d/m/Y', strtotime($appointment_date_time)) }}</b></h3>

@if ($message = Session::get('danger'))
        <div class="alert alert-danger text-center">
            <p>{{ $message }}</p>
        </div>
@endif
@if ($message = Session::get('info'))
    <div class="alert alert-info text-center">
        <p>{{ $message }}</p>
    </div>
@endif

<div class="row row-cols-1 row-cols-lg-2 row-cols-xl-4">
    @foreach ($consults as $consult)  
        <div class="col">
            <div class="card radius-15">
                <div class="card-body text-center">
                    <div class="p-4 border radius-15">
                        <img src="{{ asset('assets/img/profile-pictures/' . substr($consult->patient->photo, 28)) }}" alt="Foto de perfil" width="320">
                  
                        <h4 class="mb-0 mt-3">{{ $consult->patient->name }}</h4>
                        <p class="mb-3">{{ substr($consult->appointment_date_time, 10, 6) }}</p>
                        <p class="mb-3">{{ $consult->description }}</p>
                        <div class="button-group"> 
                            <a href="{{ route('consults.edit', $consult->id) }}" class="btn btn-outline-success radius-15">Editar horário</a>

                            <form action="{{ route('consults.destroy', $consult->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-outline-danger radius-15 mt-2">Cancelar consulta</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>


@endsection
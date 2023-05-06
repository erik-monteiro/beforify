@extends('includes.layout')
 
@section('content')
    <div class="container-fluid p-4 shadow mx-auto" style="max-width: 1000px;">
        @if ($message = Session::get('success'))
            <div class="alert alert-success text-center">
                <p>{{ $message }}</p>
            </div>
        @endif

        @if ($message = Session::get('info'))
            <div class="alert alert-info text-center">
                <p>{{ $message }}</p>
            </div>
        @endif

        @if ($message = Session::get('danger'))
            <div class="alert alert-danger text-center">
                <p>{{ $message }}</p>
            </div>
        @endif

        <h3 class="text-center mb-4">Lista de pacientes</h3>
   
        @foreach ($patients as $patient)
        <div class="row">
            <div class="col-sm-4 col-md-3">
                <img src="{{ $patient->photo }}" class="border border-primary d-block mx-auto rounded-circle h-40" style="width: 170px;">
                <h3 class="text-center mt-2">{{ $patient->name }}</h3>
                <br>
                <div class="text-center">
                    <form action="{{ route('patients.destroy', $patient->id) }}" method="POST">
                        <div class="row mb-2">
                            <div class="col-4">
                                <a href="{{ route('patients.show', $patient->id) }}" class="btn btn-sm btn-outline-primary radius-15">Ver tudo</a>
                            </div>
                         
                            <div class="col-4">
                                <a href="{{ route('patients.edit', $patient->id) }}" class="btn btn-sm btn-outline-success radius-15">
                                    Editar
                                </a>
                            </div>
                      
                            @csrf
                            @method('DELETE')
                            <div class="col-4">
                                <button class="btn btn-sm btn-outline-danger radius-15">Excluir</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            
            <div class="col-sm-8 col-md-9 bg-light p-2">
                <table class="table table-hover table-striped table-bordered">
                    <tr><th>Nome:</th><td>{{ $patient->name }}</td></tr>
                    <tr><th>Sobrenome:</th><td>{{ $patient->lastname }}</td></tr>
                    <tr><th>Email:</th><td>{{ $patient->email }}</td></tr>
                    <tr><th>Gender:</th><td>{{ ucfirst($patient->gender) }}</td></tr>
                    <tr><th>Data de entrada:</th><td>{{ date_format($patient->created_at, 'd/m/Y') }}</td></tr>
                </table>
            </div>
        </div>
        <br>
        <div class="container-fluid mb-5">
            <div class="row">
                <ul class="nav nav-tabs">
                    <li class="nav-item col-sm-12 col-lg-3">
                        <a class="nav-link active" href="#" style="color: blue">Informações básicas</a>
                    </li>
                    <li class="nav-item col-sm-12 col-lg-3">
                        <a class="nav-link active" href="{{ route('exams.index', $patient->id) }}">Exames</a>
                        <ul class="nav nav-tabs">
                            @foreach ($patient->exams->take(4) as $exam)            
                                <li class="nav-item col-sm-12 col-lg-12 nav-link">{{ substr($exam->file_path, 23) }}</li>   
                                <?php //return Storage::download($exam->file_path); ?>            
                            @endforeach
                            @if (count($patient->exams) == 0)
                                <div class="container text-center">
                                    <p class="p-2 text-center mt-2 mb-2">Nenhum exame cadastrado ainda!  
                                        <a style="color: blue;" href="{{ route('exams.create', $patient->id) }}">Clique aqui</a> para incluir um registro
                                    </p>
                                </div>
                            @endif
                            @if (count($patient->exams) > 4)
                                <div class="container text-center">
                                    <a href="{{ route('exams.index', $patient->id) }}" class="btn btn-sm btn-secondary mb-2 mt-2">Ver todos</a>
                                </div>
                            @endif
                        </ul>
                    </li>

                    <li class="nav-item col-sm-12 col-lg-3">
                        <a href="{{ route('consults.show', date('Y-m-d')) }}" class="nav-link active">Consultas</a>
                        <ul class="nav nav-tabs">
                            @foreach ($patient->consults->take(4) as $consult)            
                                <li class="nav-item col-sm-12 col-lg-12 nav-link">{{ date('d/m/Y H:i', strtotime($consult->appointment_date_time)) }}</li>               
                            @endforeach
                            @if (count($patient->consults) == 0)
                                <div class="container text-center">
                                    <p class="p-2 text-center mt-2 mb-2">Nenhuma consulta marcada ainda!
                                        <a style="color: blue;" href="{{ route('consults.create', $patient->id) }}">Clique aqui</a> para incluir um registro
                                    </p>
                                </div>
                            @endif
                            @if (count($patient->consults) > 4)
                                <div class="container text-center">
                                    <a href="{{ route('consults.index', $patient->id) }}" class="btn btn-sm btn-secondary mb-2 mt-2">Ver consultas</a>
                                </div>
                            @endif
                        </ul>
                    </li>

                    <li class="nav-item col-sm-12 col-lg-3">
                        <a href="#" class="nav-link active">Fotos de antes e depois</a>
                        <ul class="nav nav-tabs">
                            @if (count($patient->photos) == 0)
                                <div class="container text-center">
                                    <p class="p-2 text-center mt-2 mb-2">Nenhuma foto adicionada ainda!
                                        <a style="color: blue;" href="{{ route('patientsPhotos.index', $patient->id) }}">Clique aqui</a> para incluir um registro
                                    </p>
                                </div>
                            @else 
                                <div class="container text-center">
                                    <a href="{{ route('patientsPhotos.index', $patient->id) }}" class="btn btn-sm btn-secondary mb-2 mt-4">Ver fotos</a>
                                </div> 
                            @endif 
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        @endforeach

        <div class="container text-center">
            <a href="{{ route('patients.create') }}" class="btn btn-primary mt-4">Adicionar novo paciente</a>
        </div>
    </div>
@endsection
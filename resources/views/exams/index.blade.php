@extends('includes.layout')

@section('content')
    <div class="container-fluid p-4 shadow mx-auto" style="max-width: 1000px;">
        <h3 class="text-center mb-4">Lista de exames</b></h3>

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

        <table class="table table-hover table-striped table-bordered">
            <tr>
                <th>ID</th>
                <th>Exame</th>
                <th>Descrição</th>
                <th>Download</th>
                <th>Nome do paciente</th>
                <th>Data de criação</th>
                <th>Ações</th>
            </tr>
            @foreach ($exams as $exam)
            <tr>
                <td>{{ $exam->id }}</td>
                <td>{{ $exam->exam }}</td>
                <td>{{ $exam->description }}</td>
                <td><a href="#" style="color: blue;">{{ substr($exam->file_path, 23) }}</a></td>
                <td>{{ $exam->patient->name }}</td>
                <td>{{ date_format($exam->created_at, 'd/m/Y') }}</td>
                <td class="col-2">
                    <form action="{{ route('exams.destroy', $exam->id) }}" method="POST">     
                        <a href="{{ route('exams.edit', $exam->id) }}" class="btn-sm btn btn-success">Editar</a>
                            
                        @csrf
                        @method('DELETE')
                        <button class="btn-sm btn btn-danger">Excluir</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
    <hr>
    <div class="container text-center">
        <a href="{{ route('exams.create', ['patient_id' => $exam->patient_id]) }}" class="btn btn-primary mt-4">Adicionar novo exame</a>
    </div>
    </div>
@endsection
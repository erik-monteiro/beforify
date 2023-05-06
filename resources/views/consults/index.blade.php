@extends('includes.layout')

@section('content')
<div class="container text-center">
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
            <div class="alert alert-info text-center">
                <p>{{ $message }}</p>
            </div>
    @endif

    @if (count($consults) == 0)
        <p>Nenhuma consulta marcada para este mês ainda</p>
    @endif

    <a href="{{ route('consults.create') }}" class="btn btn-primary">Marcar nova consulta</a>
</div>

<div class="container mx-auto mt-10">
    <div class="wrapper bg-white rounded shadow w-full ">
      <div class="header flex justify-between border-b p-2">
        <span class="text-lg font-bold">
          {{ $day }} de
          {{ $monthString }} de
          {{ $year }}
        </span>
      </div>
      <table class="w-full">
        <thead>
          <tr>
            <th class="p-2 border-r h-10 xl:w-40 lg:w-30 md:w-30 sm:w-20 w-10 xl:text-sm text-xs">
              <span class="xl:block lg:block md:block sm:block hidden">Domingo</span>
              <span class="xl:hidden lg:hidden md:hidden sm:hidden block">Dom</span>
            </th>
            <th class="p-2 border-r h-10 xl:w-40 lg:w-30 md:w-30 sm:w-20 w-10 xl:text-sm text-xs">
              <span class="xl:block lg:block md:block sm:block hidden">Segunda</span>
              <span class="xl:hidden lg:hidden md:hidden sm:hidden block">Seg</span>
            </th>
            <th class="p-2 border-r h-10 xl:w-40 lg:w-30 md:w-30 sm:w-20 w-10 xl:text-sm text-xs">
              <span class="xl:block lg:block md:block sm:block hidden">Terça</span>
              <span class="xl:hidden lg:hidden md:hidden sm:hidden block">Ter</span>
            </th>
            <th class="p-2 border-r h-10 xl:w-40 lg:w-30 md:w-30 sm:w-20 w-10 xl:text-sm text-xs">
              <span class="xl:block lg:block md:block sm:block hidden">Quarta</span>
              <span class="xl:hidden lg:hidden md:hidden sm:hidden block">Qua</span>
            </th>
            <th class="p-2 border-r h-10 xl:w-40 lg:w-30 md:w-30 sm:w-20 w-10 xl:text-sm text-xs">
              <span class="xl:block lg:block md:block sm:block hidden">Quinta</span>
              <span class="xl:hidden lg:hidden md:hidden sm:hidden block">Qui</span>
            </th>
            <th class="p-2 border-r h-10 xl:w-40 lg:w-30 md:w-30 sm:w-20 w-10 xl:text-sm text-xs">
              <span class="xl:block lg:block md:block sm:block hidden">Sexta</span>
              <span class="xl:hidden lg:hidden md:hidden sm:hidden block">Sex</span>
            </th>
            <th class="p-2 border-r h-10 xl:w-40 lg:w-30 md:w-30 sm:w-20 w-10 xl:text-sm text-xs">
              <span class="xl:block lg:block md:block sm:block hidden">Sábado</span>
              <span class="xl:hidden lg:hidden md:hidden sm:hidden block">Sab</span>
            </th>
          </tr>
        </thead>

        <tbody>
           @for ($i = 1; $i <= $daysInMonth; $i++)
                @if ($i == 1 || date('w', strtotime($year.'-'.$month.'-'.$i)) == 0)
                  <tr class="text-center h-20">
                @endif   
                    <td class="border p-1 h-40 xl:w-40 lg:w-30 md:w-30 sm:w-20 w-10 overflow-auto transition cursor-pointer duration-500 ease hover:bg-gray-300 ">
                      <div class="flex flex-col h-100 mx-auto xl:w-40 lg:w-30 md:w-30 sm:w-full w-10 mx-auto overflow-hidden">
                        <div class="top h-5 w-full">
                          <span class="text-gray-500">{{ $i }}</span>
                        </div>
                        @foreach ($consults as $consult)
                          @if (substr($consult->appointment_date_time, 8, 2) == $i && 
                               substr($consult->appointment_date_time, 0, 4) == date('Y'))
                            <a href="{{ route('consults.show', date('Y-m-d', strtotime($consult->appointment_date_time))) }}">
                              <span class="badge text-bg-info mb-2 mt-2 rounded-pill">
                                {{ ucfirst($consult->description) }} <br>
                                {{ $consult->patient->name }} <br>
                                {{ substr($consult->appointment_date_time, 10, 6) }}
                              </span>    
                            </a>          
                          @endif
                        @endforeach
                      </div>
                    </td>    
                  @if ($i == $daysInMonth || date('w', strtotime($year.'-'.$month.'-'.$i)) == 6)
                  </tr>
                  @endif
            @endfor
        </tbody>
      </table>
    </div>
  </div>
@endsection
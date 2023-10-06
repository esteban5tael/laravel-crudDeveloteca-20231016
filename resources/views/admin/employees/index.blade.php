@extends('adminlte::page')

@section('title', 'Lista de Empleados')

@section('content_header')
    <h1>Lista de Empleados</h1>
@stop

@section('content')

    <div class="container">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Email</th>
                    <th>Foto</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($employees as $employee)
                    <tr>
                        <td>{{ $employee->id }}</td>
                        <td>{{ $employee->name }}</td>
                        <td>{{ $employee->lastname }}</td>
                        <td>{{ $employee->email }}</td>
                        <td>
                            @if ($employee->photo)
                                <img src="{{ asset('storage/' . $employee->photo) }}" alt="{{ $employee->name }}'s Photo" width="100">
                            @else
                                Sin foto
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{$employees->links()}}
    </div>

@stop

@section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
    <link rel="stylesheet" href="{{ asset('storage/assets/css/bootstrap.min.css') }}">
@stop

@section('js')
    {{-- <script> console.log('Hi!'); </script> --}}
@stop

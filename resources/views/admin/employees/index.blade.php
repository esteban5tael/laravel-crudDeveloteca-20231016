@extends('adminlte::page')

@section('title', 'Lista de Empleados')

@section('content_header')
    <h1>Lista de Empleados</h1>
@stop

@section('content')

    <div class="container">


        @if (Session::has('message'))
            <div class="text-bg-secondary p-3 rounded" style="text-align: center">
                <strong>{{ session('message') }}</strong>
            </div>
            <br>
        @endif

        <div class="card">

            <a class="btn btn-primary" href="{{ route('admin.employees.create') }}">{{ __('Create') }}</a>

        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Email</th>
                    <th>Foto</th>
                    <th>{{ __('Actions') }}</th>
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
                                <img src="{{ asset('storage/' . $employee->photo) }}" alt="{{ $employee->name }}'s Photo"
                                    width="100">
                            @else
                                Sin foto
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.employees.show', $employee->id) }}">
                                <i class="fas fa-eye"></i>
                                {{-- Ver --}}
                            </a>
                            <a href="{{ route('admin.employees.edit', $employee->id) }}">
                                <i class="fas fa-edit"></i>
                                {{-- Editar --}}
                            </a>
                            <form method="POST" action="{{ route('admin.employees.destroy', $employee->id) }}">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-link text-danger"
                                    onclick="return confirm('¿Seguro Deseas Eliminar Éste Empleado?')">
                                    <i class="fas fa-trash-alt"></i>
                                    {{-- Eliminar --}}
                                </button>
                            </form>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $employees->links() }}
    </div>

@stop

@section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
    <link rel="stylesheet" href="{{ asset('storage/assets/css/bootstrap.min.css') }}">

@stop

@section('js')
    {{-- <script> console.log('Hi!'); </script> --}}
@stop

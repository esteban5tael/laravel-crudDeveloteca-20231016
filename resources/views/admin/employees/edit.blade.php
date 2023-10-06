@extends('adminlte::page')

@section('title', 'Editar Empleado')

@section('content_header')
    <h1>Editar Empleado</h1>
@stop

@section('content')

    <form action="{{ route('admin.employees.update', $employee->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('admin.employees.form',['mode'=>'edit'])
    </form>
@stop

@section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
    <link rel="stylesheet" href="{{ asset('storage/assets/css/bootstrap.min.css') }}">
@stop

@section('js')
    {{-- <script> console.log('Hi!'); </script> --}}
@stop

@extends('adminlte::page')

@section('title', 'Crear Empleado')

@section('content_header')
    <h1>Crear Empleado</h1>
@stop

@section('content')



    <form action="{{ route('admin.employees.store') }}" method="post" enctype="multipart/form-data">
        @csrf

        @include('admin.employees.form',['mode'=>'create'])
    </form>


@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('storage/assets/css/bootstrap.min.css') }}">
@stop

@section('js')
    {{-- <script> console.log('Hi!'); </script> --}}
@stop

@extends('adminlte::page')

@section('title', 'Crear Empleado')

@section('content_header')
    <h1>Crear Empleado</h1>
@stop

@section('content')

    <form action="{{ route('admin.employees.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="user_id" id="user_id" value="{{ $user_id }}" autocomplete="off">
        
        {{--  --}}
        <div class="form-group">
            <label for="name">{{ __('Name') }}: </label>
            <input type="text" class="form-control" id="name" name="name">
        </div>
        {{--  --}}
        <div class="form-group">
            <label for="lastname">{{ __('Last Name') }}:</label>
            <input type="text" class="form-control" id="lastname" name="lastname">
        </div>
        {{--  --}}
        <div class="form-group">
            <label for="email">{{ __('Email') }}:</label>
            <input type="text" class="form-control" id="email" name="email">
        </div>
        {{--  --}}
        <div class="form-group">
            <label for="photo">{{ __('Photo') }}:</label>
            <input type="file" class="form-control" id="photo" name="photo">
        </div>
        {{--  --}}


        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </form>

    {{--  --}}


@stop

@section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
    <link rel="stylesheet" href="{{ asset('storage/assets/css/bootstrap.min.css') }}">
@stop

@section('js')
    {{-- <script> console.log('Hi!'); </script> --}}
@stop

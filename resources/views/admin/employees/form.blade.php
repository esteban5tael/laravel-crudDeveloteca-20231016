@if ($errors->any())
    <div class="alert alert-danger">
        Por favor, verifique que todos los campos tengan valores correctos.
    </div>
@endif
<input type="hidden" name="user_id" id="user_id" value="{{ $user_id }}" autocomplete="off">

{{--  --}}
<div class="form-group">
    <label for="name">{{ __('Name') }}: </label>
    <input type="text" class="form-control" id="name" name="name"
        value="{{ old('name', isset($employee->name) ? $employee->name : '') }}">
</div>
{{--  --}}
<div class="form-group">
    <label for="lastname">{{ __('Last Name') }}:</label>
    <input type="text" class="form-control" id="lastname" name="lastname"
        value="{{ old('lastname', isset($employee->lastname) ? $employee->lastname : '') }}">
</div>
{{--  --}}
<div class="form-group">
    <label for="email">{{ __('Email') }}:</label>
    <input type="text" class="form-control" id="email" name="email"
        value="{{ old('email', isset($employee->email) ? $employee->email : '') }}">
</div>
{{--  --}}
<div class="form-group">
    <label for="photo">{{ __('Photo') }}:</label>
    <input type="file" class="form-control" id="photo" name="photo"
        value="{{ old('photo', isset($employee->photo) ? $employee->photo : '') }}">
</div>

@if (isset($employee))
    @if ($employee->photo)
        <img src="{{ asset('storage/' . $employee->photo) }}" alt="{{ $employee->name }}'s Photo" width="100"><br>
    @else
        Sin foto
    @endif

@endif
{{--  --}}


<button type="submit" class="btn btn-primary">
    @switch($mode)
        @case('create')
        {{ __('Create') }}
        @break

        @case('edit')
            {{ __('Edit') }}
        @break

        @default
    @endswitch

</button>

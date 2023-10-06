<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Listado Público de Empleados</title>
    <link rel="stylesheet" href="{{ asset('storage/assets/css/bootstrap.min.css') }}">
</head>

<body>
    <div class="container p-3">
        <div class="card">
            <div class="card-body text-center">
                <h4>Listado Público de Empleados</h4>
            </div>
            
        </div>
        <button class="btn "><a href="{{ route('index') }}">Volver</a></button>
        <table class="table table-striped table-hover">
            <thead class="thead-dark">
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
                                <img src="{{ asset('storage/' . $employee->photo) }}"
                                    alt="{{ $employee->name }}'s Photo" width="100">
                            @else
                                Sin foto
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $employees->links() }}
    </div>
</body>

</html>

<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = Employee::orderBy('id', 'desc')->paginate(5); // Obtén todos los empleados ordenados por ID en orden descendente.


        return view('admin.employees.index', compact('employees'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //

        $user_id = "";

        if (Auth::check()) {
            $user_id = Auth::id();
        } else {
            return redirect()->route('login');
        }


        return view('admin.employees.create', compact('user_id'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validación de datos
        $request->validate([
            'name' => 'required|string',
            'lastname' => 'required|string',
            'email' => 'required|email',
            'photo' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Asegúrate de definir las reglas de validación para la foto.
        ]);

        // Obtén el archivo de la solicitud
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo')->store('assets/img/employees',['']);
        } else {
            $photo = null; // Si no se proporcionó una foto, asigna null.
        }

        // Obtén los demás datos del formulario
        $user_id = $request->input('user_id');
        $name = $request->input('name');
        $lastname = $request->input('lastname');
        $email = $request->input('email');

        // Ahora puedes usar los datos y la ruta de la foto para guardar en la base de datos o realizar otras acciones.

        // Por ejemplo, puedes crear un nuevo empleado:
        $employee = new Employee([
            'user_id' => $user_id,
            'name' => $name,
            'lastname' => $lastname,
            'email' => $email,
            'photo' => $photo, // Asigna la ruta de la foto aquí.
        ]);

        $employee->save();

        // Puedes devolver una respuesta de éxito, redireccionar, etc., según tus necesidades.
        return to_route('admin.employees.index')->with('message', 'Empleado Creado Exitosamente');
    }


    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        //
        return view('admin.employees.show', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        //
        return view('admin.employees.edit', compact('employee'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employee $employee)
    {
        //
        $employee->update($request->all());
        return redirect()->route('employees.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        //
        $employee->delete();
        return redirect()->route('employees.index');
    }
}

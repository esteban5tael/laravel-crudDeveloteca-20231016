<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

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
            $photo = $request->file('photo')->store('assets/img/employees', ['']);
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
        $user_id = "";

        if (Auth::check()) {
            $user_id = Auth::id();
        } else {
            return redirect()->route('login');
        }


        return view('admin.employees.edit', compact('employee', 'user_id'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employee $employee)
    {
        // Validación de datos
        $request->validate([
            'name' => 'required|string',
            'lastname' => 'required|string',
            'email' => 'required|email',
            'photo' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Asegúrate de definir las reglas de validación para la foto.
        ]);

        // Actualizar los campos del empleado con los nuevos valores del formulario
        $employee->name = $request->input('name');
        $employee->lastname = $request->input('lastname');
        $employee->email = $request->input('email');

        // Obtener la foto actual del empleado
        $currentPhoto = $employee->photo;

        // Obtener el archivo de la solicitud y actualizar la foto si se proporciona uno nuevo
        if ($request->hasFile('photo')) {
            // Validar y almacenar el nuevo archivo
            $newPhoto = $request->file('photo')->store('assets/img/employees', ['']);

            // Actualizar la ruta de la foto en el modelo
            $employee->photo = $newPhoto;

            // Si hay una foto anterior, eliminarla
            if ($currentPhoto) {
                // Asegurarse de que la foto anterior no sea la imagen por defecto
                if ($currentPhoto !== 'assets/img/default.jpg') {
                    // Eliminar la foto anterior
                    
                    try {
                        unlink($currentPhoto);
                    } catch (\Throwable $th) {
                    }
                }
            }
        }

        // Guardar los cambios en el empleado
        $employee->save();

        // Redirigir a la página de detalles del empleado o a donde desees
        return redirect()->route('admin.employees.index')->with('message', 'Empleado Actualizado Exitosamente');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        // Obtén la ruta de la foto antes de eliminar el empleado
        $photoPath = public_path($employee->photo);


        // Verifica si la foto existe antes de intentar eliminarla
        if (File::exists($photoPath)) {
            // Elimina la foto
            
            try {
                unlink($photoPath);
            } catch (\Throwable $th) {
            }
        }

        // Luego, elimina al empleado
        $employee->delete();

        return redirect()->route('admin.employees.index')->with('message', 'Empleado Eliminado Exitosamente');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Controllers\Requestt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TablesController extends Controller
{
    private function obtenerUsuarios()
    {
        $employeesAndAdmins = User::whereIn('userType', ['Trabajador', 'Administrador'])
            ->select('id', 'name', 'lastName', 'phone', 'email', 'status', 'created_at')
            ->get();

        $clients = User::where('userType', 'cliente')
            ->select('id', 'name', 'lastName', 'phone', 'email', 'status', 'created_at')
            ->get();

        return compact('employeesAndAdmins', 'clients');
    }

    public function index()
    {
        $employeesAndAdmins = User::where('userType', 'Administrador')->orWhere('userType', 'Trabajador')->get();
        $clients = User::where('userType', 'Cliente')->get();

        return view('tables', compact('employeesAndAdmins', 'clients'));
    }


    public function editar($id)
    {
        $usuario = DB::select('CALL sp_get_cli_yair()');
        $usuario = collect($usuario)->firstWhere('id', $id);

        if (!$usuario) {
            return redirect()->back()->withErrors('El usuario no existe.');
        }

        return view('tablesEditar', compact('usuario'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:30',
            'email' => 'required|email|unique:users,email,' . $id,
            'phone' => 'nullable|string|max:10',
        ]);

        try {
            DB::statement('CALL sp_up_cli_yair(?, ?, ?, ?, ?, ?, ?, ?, ?)', [
                $id,
                $request->input('name'),
                $request->input('lastName'),
                $request->filled('password') ? bcrypt($request->input('password')) : null, // Solo aplica bcrypt si hay contraseña
                $request->input('email'),
                $request->input('phone'),
                $request->input('location'),
                $request->input('about_me'),
                $request->input('status') === 'Activo' ? 1 : 0
            ]);
        } catch (\Illuminate\Database\QueryException $e) {
            // Verifica si el error es por violación de restricción de clave única (código de error '23000')
            if ($e->getCode() === '23000' && strpos($e->getMessage(), 'email') !== false) {
                return redirect()->back()->withErrors('El correo electrónico ya está registrado. Intenta con otro.')->withInput();
            }

            // Si hay otro error SQL, lo re-lanzamos
            throw $e;
        }

        return redirect()->route('tables')->with('success', 'Usuario actualizado con éxito.');
    }


    public function destroy($id)
    {
        DB::statement('CALL sp_del_cli_yair(?)', [$id]);
        return redirect()->route('tables')->with('success', 'Usuario eliminado con éxito.');
    }

    public function show($id)
    {
        $usuario = DB::select('CALL sp_get_cli_yair()');
        $usuario = collect($usuario)->firstWhere('id', $id);

        if (!$usuario) {
            return redirect()->route('tables')->withErrors('El usuario no existe.');
        }
        return view('tablesShow', compact('usuario'));
    }

    public function create()
    {
        return view('tablesNewUser');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:30',
            'lastName' => 'required|string|max:30',
            'email' => 'required|email|max:50',
            'password' => 'required|string|min:6',
            'phone' => 'nullable|string|max:20',
            'location' => 'nullable|string|max:100',
            'about_me' => 'nullable|string|max:255',
            'status' => 'required|string|max:50',
            'userType' => 'required|string|in:Cliente,Administrador,Trabajador',
        ]);

        try {
            DB::select('CALL sp_ins_cli_yair(?, ?, ?, ?, ?, ?, ?, ?, ?)', [
                $request->name,
                $request->lastName,
                bcrypt($request->password),
                $request->email,
                $request->phone,
                $request->location,
                $request->about_me,
                $request->status,
                $request->userType,
            ]);
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() === '23000') { // Código de error SQL para violación de restricción de clave única
                return redirect()->back()->withErrors('El correo electrónico ya está registrado. Intenta con otro.')->withInput();
            }

            throw $e; // Re-lanza otras excepciones
        }

        return redirect()->route('tables')->with('success', 'Usuario creado correctamente');
    }
}

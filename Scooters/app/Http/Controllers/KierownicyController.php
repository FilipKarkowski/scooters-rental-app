<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Placowki;
use Illuminate\Support\Facades\Gate;

class KierownicyController extends Controller
{
    public function index()
    {
        $clients = User::where('role', 'client')->get();
        $employees = User::where('role', 'employee')->get();
        $admins = User::where('role', 'admin')->get();

        return view('kierownicy', compact('clients', 'employees', 'admins'));
    }


    public function create()
    {
        if (Gate::allows('create-employee', auth()->user())) {
            // Użytkownik ma uprawnienia do tworzenia pracownika
            $placowki = Placowki::all();
            return view('users.create', compact('placowki'));
        } else {
            // Użytkownik nie ma uprawnień, przekieruj lub zwróć odpowiedni komunikat
        }
    }

    public function store(Request $request)
    {
        if (Gate::allows('create-employee', auth()->user())) {
            // Użytkownik ma uprawnienia do tworzenia pracownika
            $employee = new User;
            $employee->name = $request->input('name');
            $employee->email = $request->input('email');
            $employee->password = bcrypt($request->input('password'));
            $employee->salary = $request->input('salary');
            $employee->role = 'employee';
            $employee->id_placowki = $request->input('id_placowki');
            $employee->save();

            return redirect('/users'); // Zmieniono ścieżkę przekierowania
        } else {
            // Użytkownik nie ma uprawnień, przekieruj lub zwróć odpowiedni komunikat
        }
    }

    public function edit(User $employee)
    {
        if (Gate::allows('edit-employee', [auth()->user(), $employee])) {
            // Użytkownik ma uprawnienia do edycji pracownika
            $placowki = Placowki::all();
            return view('users.edit', compact('employee', 'placowki'));
        } else {
            // Użytkownik nie ma uprawnień, przekieruj lub zwróć odpowiedni komunikat
        }
    }
    public function update(Request $request, $id)
    {
        $employee = User::findOrFail($id);
        $employee->name = $request->input('name');
        $employee->email = $request->input('email');
        $employee->salary = $request->input('salary');
        $employee->id_placowki = $request->input('id_placowki');
        $employee->role = $request->input('role'); // Dodajanie roli pracownika
        $employee->save();

        return redirect('/users');
    }



    public function destroy(User $employee)
    {
        if (Gate::allows('delete-employee', auth()->user())) {
            // Użytkownik ma uprawnienia do usunięcia pracownika
            $employee->delete();
            //...
        } else {
            // Użytkownik nie ma uprawnień, przekieruj lub zwróć odpowiedni komunikat
        }

        return redirect('/users'); // Zmieniono ścieżkę przekierowania
    }
}

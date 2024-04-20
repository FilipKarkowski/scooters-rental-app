<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Placowki;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    public function index()
    {
        $clients = User::where('role', 'client')->get();
        $employees = User::where('role', 'employee')->get();
        $admins = User::where('role', 'admin')->get();
    
        return view('users', compact('clients', 'employees', 'admins'));
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
       // if (Gate::allows('create-employee', auth()->user())) {            // wylaczylem bramki bo nie ma zrobionych polityk podobno pepeW 
            // Użytkownik ma uprawnienia do tworzenia pracownika
            $pracownik = new User;
            $pracownik->name = $request->input('name');
            $pracownik->email = $request->input('email');
            $pracownik->password = bcrypt($request->input('password'));
            $pracownik->salary = $request->input('salary');
            $pracownik->role = 'employee';
            $pracownik->id_placowki = $request->input('id_placowki');
            $pracownik->save();

            return redirect('/pracownicy')->with('success', 'Pracownik został pomyślnie utworzony.');
       // } else {
            // Użytkownik nie ma uprawnień, przekieruj lub zwróć odpowiedni komunikat
           // return redirect('/')->with('error', 'Nie masz uprawnień do tworzenia pracownika.');
       // }
    }

    public function storeklient(Request $request)
    {
       // if (Gate::allows('create-employee', auth()->user())) {            // wylaczylem bramki bo nie ma zrobionych polityk podobno pepeW 
            // Użytkownik ma uprawnienia do tworzenia pracownika
            $pracownik = new User;
            $pracownik->name = $request->input('name');
            $pracownik->opis = $request->input('email');
            $pracownik->role = 'client';

            $pracownik->save();

            return redirect('/kliencikonta')->with('success', 'klient zostal dodany.');
       // } else {
            // Użytkownik nie ma uprawnień, przekieruj lub zwróć odpowiedni komunikat
           // return redirect('/')->with('error', 'Nie masz uprawnień do tworzenia pracownika.');
       // }
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
    
        return redirect('/kliencikonta');
    }
    
    


    public function destroy(User $id)
    {
        $id->delete();
        return redirect('/pracownicy');
    }
}
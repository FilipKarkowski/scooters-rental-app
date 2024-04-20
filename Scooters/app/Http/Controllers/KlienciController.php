<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Placowki;
use Illuminate\Support\Facades\Gate;
use App\Models\Klienci;


class KlienciController extends Controller
{
    public function index()
    {
        $clients = Klienci::all();
        $employees = User::where('role', 'employee')->get();
        $admins = User::where('role', 'admin')->get();

        return view('klienci', compact('clients', 'employees', 'admins'));
    }


    public function create()
    {
        if (Gate::allows('create-employee', auth()->user())) {
            // Użytkownik ma uprawnienia do tworzenia pracownika
            $placowki = Placowki::all();
            return view('klienci.create', compact('placowki'));
        } else {
            // Użytkownik nie ma uprawnień, przekieruj lub zwróć odpowiedni komunikat
        }
    }


    public function store(Request $request)
    {
        $klient = new Klienci;
        $klient->Imie = $request->input('imie');
        $klient->Nazwisko = $request->input('nazwisko');
        $klient->Telefon = $request->input('telefon');
        $klient->save();

        return redirect('/klienci');
    }

    public function destroy($id)
    {
        $klient = Klienci::findOrFail($id);
        $klient->delete();

        return redirect('/klienci');
    }

    public function update(Request $request, Klienci $klient)
    {
        $klient->Imie = $request->input('imie');
        $klient->Nazwisko = $request->input('nazwisko');
        $klient->Telefon = $request->input('telefon');
        $klient->save();

        return redirect('/klienci');
    }



}

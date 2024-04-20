<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Placowki;

class PlacowkiController extends Controller
{
    public function index()
    {
        $placowki = Placowki::all();

        return view('placowki', compact('placowki'));
    }

    public function store(Request $request)
    {
        $placowka = new Placowki;
        $placowka->nazwa = $request->input('nazwa');
        $placowka->adres = $request->input('adres');
        $placowka->save();

        return redirect('/placowki');
    }
    public function update(Request $request, Placowki $placowka)
    {
        $placowka->nazwa = $request->input('nazwa');
        $placowka->adres = $request->input('adres');
        $placowka->save();

        return redirect('/placowki');
    }
    public function destroy($id)
    {
        $placowka = Placowki::findOrFail($id);
        $placowka->delete();
        //

        return redirect('/placowki');
    }
}

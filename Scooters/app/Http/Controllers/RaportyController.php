<?php

namespace App\Http\Controllers;

use App\Models\Raporty;
use App\Models\Placowki;
use App\Models\Odbiory;
use App\Models\Rewizje;
use App\Models\Wypozyczenia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class RaportyController extends Controller
{
    public function index()
    {
        $raporty = Raporty::all();
        $placowki = Placowki::all();
        $odbiory = Odbiory::all();
        $rewizje = Rewizje::all();
        $wypozyczenia = Wypozyczenia::all();

        return view('raporty', compact('raporty', 'placowki', 'odbiory', 'rewizje', 'wypozyczenia'));
    }

    public function store(Request $request)
    {
        $raport = new Raporty;
        $placowkaId = $request->input('placowka_id');
        $placowka = Placowki::findOrFail($placowkaId);

        $raport->placowka_id = $placowkaId;

        $wypozyczeniaId = $request->input('wypozyczenia_id');
        $liczbaWypozyczen = Wypozyczenia::where('id', $wypozyczeniaId)->count();
        $raport->liczba_wypozyczen = $liczbaWypozyczen;

        //this should totally not be just 'id'
        $liczbaOdbiorow = Odbiory::where('id', $placowkaId)->count();
        $raport->liczba_odbiorow = $liczbaOdbiorow;

        $liczbaUszkodzonych = Rewizje::where('id', $placowkaId)->count();
        $raport->liczba_uszkodzonych = $liczbaUszkodzonych;

        $kosztWypozyczenia = Odbiory::where('id', $placowkaId)->sum('koszt_wypozyczenia');
        $raport->zysk = $kosztWypozyczenia;

        $raport->save();

        return redirect('/raporty');
    }

    public function edit($id)
    {
        $raport = Raporty::findOrFail($id);
        $placowki = Placowki::all();
        $odbiory = Odbiory::all();
        $rewizje = Rewizje::all();
        $wypozyczenia = Wypozyczenia::all();

        return view('raporty.edit', compact('raport', 'placowki', 'odbiory', 'rewizje', 'wypozyczenia'));
    }

    public function update(Request $request, $id)
    {
        $raport = Raporty::findOrFail($id);
        $raport->data = $request->input('data');
        $raport->liczba_wypozyczen = $request->input('liczba_wypozyczen');
        $raport->liczba_odbiorow = $request->input('liczba_odbiorow');
        $raport->liczba_uszkodzonych = $request->input('liczba_uszkodzonych');
        $raport->zysk = $request->input('zysk');
        $raport->placowka_id = $request->input('placowka_id');
        $raport->odbiory_id = $request->input('odbiory_id');
        $raport->rewizje_id = $request->input('rewizje_id');
        $raport->wypozyczenia_id = $request->input('wypozyczenia_id');
        $raport->save();

        return redirect('/raporty');
    }

    public function destroy($id)
    {
        $raport = Raporty::findOrFail($id);
        $raport->delete();

        return redirect('/raporty');
    }
}

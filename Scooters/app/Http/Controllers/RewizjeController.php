<?php

namespace App\Http\Controllers;

use App\Models\Hulajnogi;
use App\Models\Rewizje;
use Illuminate\Http\Request;

class RewizjeController extends Controller
{
    public function index()
    {
        $hulajnogi = Hulajnogi::all();
        $rewizje = Rewizje::all();

        return view('rewizje', compact('rewizje', 'hulajnogi'));
    }

    public function store(Request $request)
    {
        $rewizja = new Rewizje;
        $rewizja->data = $request->input('data');
        $rewizja->czy_uszkodzona = $request->has('czy_uszkodzona') ? true : false;
        $rewizja->opis = $request->input('opis');
        $rewizja->koszt_uszkodzen = $request->input('koszt_uszkodzen');
        $rewizja->hulajnoga_id = $request->input('hulajnoga_id');
        $rewizja->save();

        return redirect('/rewizje');
    }


    public function update(Request $request, Rewizje $rewizja)
    {
        $rewizja->data = $request->input('data');
        $rewizja->czy_uszkodzona = $request->has('czy_uszkodzona') ? true : false;
        $rewizja->opis = $request->input('opis');
        $rewizja->koszt_uszkodzen = $request->input('koszt_uszkodzen');
        $rewizja->hulajnoga_id = $request->input('hulajnoga_id');
        $rewizja->save();

        return redirect('/rewizje');
    }
    public function destroy($id)
    {
        $rewizja = Rewizje::findOrFail($id);
        $rewizja->delete();

        return redirect('/rewizje');
    }

}

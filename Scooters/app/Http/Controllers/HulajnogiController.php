<?php

namespace App\Http\Controllers;

use App\Models\Hulajnogi;
use App\Models\Placowki;
use Illuminate\Http\Request;

class HulajnogiController extends Controller
{
    public function index()
    {
        $hulajnogi = Hulajnogi::all();
        $placowki = Placowki::all();

        return view('hulajnogi', compact('hulajnogi', 'placowki'));
    }

    public function store(Request $request)
    {
        $hulajnoga = new Hulajnogi;
        $hulajnoga->Nazwa = $request->input('nazwa');
        $hulajnoga->Model = $request->input('model');
        $hulajnoga->placowka_id = $request->input('placowka_id');
        $hulajnoga->save();

        return redirect('/hulajnogi');
    }

    public function destroy($id)
    {
        $hulajnoga = Hulajnogi::findOrFail($id);
        $hulajnoga->delete();

        return redirect('/hulajnogi');
    }

    public function update(Request $request, Hulajnogi $hulajnoga)
    {
        $hulajnoga->Nazwa = $request->input('nazwa');
        $hulajnoga->Model = $request->input('model');
        $hulajnoga->placowka_id = $request->input('placowka_id');
        $hulajnoga->save();

        return redirect('/hulajnogi');
    }
}

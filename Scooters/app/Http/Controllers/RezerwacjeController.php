<?php

namespace App\Http\Controllers;

use App\Models\Hulajnogi;
use App\Models\Placowki;
use App\Models\Rezerwacje;
use App\Models\User;
use App\Models\Wypozyczenia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RezerwacjeController extends Controller
{
    public function index()
    {
        $placowki=Placowki::all();
        $rezerwacje = Rezerwacje::all();
        $users=User::all();
        $klienci = [];
        $hulajnogi=Hulajnogi::all();
        $zajete=Hulajnogi::where('zajeta',1)->get()->toArray();

        foreach ($users as $user) {
            if ($user->isKlient()) {
                $klienci[] = $user;
            }
        }
        return view('rezerwacje', compact('rezerwacje','klienci','hulajnogi','zajete','placowki'));
    }

    public function store(Request $request)
    {
        $rezerwacja = new Rezerwacje;
        $rezerwacja->klient_id = Auth::id();

        $dataWypozyczenia = $request->input('data_wyp');
        $dataZakonczenia = $request->input('data_zak');

        $rezerwacja->data_wypozyczenia = $dataWypozyczenia;
        $rezerwacja->data_zakonczenia = $dataZakonczenia;

        $rezerwacja->placowka_id=$request->input('placowka_id');

        $rezerwacja->save();

        $hulajnogi = $request->input('hulajnogi');
        $nr=Rezerwacje::find($rezerwacja->id);
        $nr->hulajnogi()->attach($hulajnogi);

        foreach ($hulajnogi as $hulajnogaId) {
            $hulajnoga = Hulajnogi::find($hulajnogaId);
            $hulajnoga->zajeta = 1;
            $hulajnoga->save();
        }

        return redirect('/rezerwacje');
    }

    public function destroy($id)
    {
        $rezerwacja = Rezerwacje::findOrFail($id);
        $hulajnogi = $rezerwacja->hulajnogi()->pluck('hulajnoga_id')->toArray();

        $rezerwacja->delete();

        Hulajnogi::whereIn('id', $hulajnogi)->update(['zajeta' => 0]);

        return redirect('/rezerwacje');
    }

    public function update(Request $request, $id)
    {
        $rezerwacja = Rezerwacje::findOrFail($id);

        $rezerwacja2= new Rezerwacje;
        $rezerwacja2->klient_id = Auth::id();

        $dataWypozyczenia = $request->input('data_wyp');
        $dataZakonczenia = $request->input('data_zak');

        $rezerwacja2->data_wypozyczenia = $dataWypozyczenia;
        $rezerwacja2->data_zakonczenia = $dataZakonczenia;

        $rezerwacja2->placowka_id=$request->input('placowka_id');

        $rezerwacja2->save();

        $hulajnogi = $request->input('hulajnogi');
        $rezerwacja2->hulajnogi()->attach($hulajnogi);


        $hulajnogi2 = $rezerwacja->hulajnogi()->pluck('hulajnoga_id')->toArray();
        Hulajnogi::whereIn('id', $hulajnogi2)->update(['zajeta' => 0]);
        $rezerwacja->forceDelete();

        foreach ($hulajnogi as $hulajnogaId) {
            $hulajnoga = Hulajnogi::find($hulajnogaId);
            $hulajnoga->zajeta = 1;
            $hulajnoga->save();
        }

        return redirect('/rezerwacje');
    }
}

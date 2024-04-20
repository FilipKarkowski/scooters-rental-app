<?php

namespace App\Http\Controllers;

use App\Models\Rezerwacje;
use App\Models\Wypozyczenia;
use App\Models\User;
use App\Models\Hulajnogi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class WypozyczeniaController extends Controller
{
    public function index()
    {
        $rezerwacje=Rezerwacje::all();
        $wypozyczenia = Wypozyczenia::all();
        $users=User::all();
        $klienci = [];
        $hulajnogi=Hulajnogi::all();
        $zajete=Hulajnogi::where('zajeta',1)->get()->toArray();

        foreach ($users as $user) {
            if ($user->isKlient()) {
                $klienci[] = $user;
            }
        }
        return view('wypozyczenia', compact('wypozyczenia','klienci','hulajnogi','zajete','rezerwacje'));
    }

    public function store(Request $request)
    {
        if($request->input('typ_wyp')=='nowe')
        {
            $wypozyczenie = new Wypozyczenia;
            $wypozyczenie->klient_id = $request->input('klient_id');

            $dataWypozyczenia = $request->input('data_wyp');
            $dataZakonczenia = $request->input('data_zak');

            $wypozyczenie->data_wypozyczenia = $dataWypozyczenia;
            $wypozyczenie->data_zakonczenia = $dataZakonczenia;

            $wypozyczenie->pracownik_id = Auth::id();

            $wypozyczenie->save();

            $hulajnogi = $request->input('hulajnogi');
            $nr=Wypozyczenia::find($wypozyczenie->id);
            $nr->hulajnogi()->attach($hulajnogi);

            foreach ($hulajnogi as $hulajnogaId) {
                $hulajnoga = Hulajnogi::find($hulajnogaId);
                $hulajnoga->zajeta = 1;
                $hulajnoga->save();
            }
        }
        else if($request->input('typ_wyp')=='rezerwacja')
        {
            $rezerwacja=Rezerwacje::findOrFail($request->input('rezerwacja_id'));

            $wypozyczenie = new Wypozyczenia;
            $wypozyczenie->klient_id = $rezerwacja->klient_id;
            $wypozyczenie->data_wypozyczenia = $rezerwacja->data_wypozyczenia;
            $wypozyczenie->data_zakonczenia = $rezerwacja->data_zakonczenia;
            $wypozyczenie->pracownik_id = Auth::id();
            $wypozyczenie->save();

            $hulajnogi = $rezerwacja->hulajnogi()->pluck('hulajnoga_id')->toArray();
            $wypozyczenie->hulajnogi()->attach($hulajnogi);

            foreach ($hulajnogi as $hulajnogaId) {
                $hulajnoga = Hulajnogi::find($hulajnogaId);
                $hulajnoga->zajeta = 1;
                $hulajnoga->save();
            }

        }

        return redirect('/wypozyczenia');
    }

    public function destroy($id)
    {
        $wypozyczenie = Wypozyczenia::findOrFail($id);
        $hulajnogi = $wypozyczenie->hulajnogi()->pluck('hulajnoga_id')->toArray();

        $wypozyczenie->delete();

        Hulajnogi::whereIn('id', $hulajnogi)->update(['zajeta' => 0]);

        return redirect('/wypozyczenia');
    }

    public function update(Request $request, $id)
    {
        $wypozyczenie = Wypozyczenia::findOrFail($id);

        $wypozyczenie2= new Wypozyczenia;
        $wypozyczenie2->klient_id = $request->input('klient_id');

        $dataWypozyczenia = $request->input('data_wyp');
        $dataZakonczenia = $request->input('data_zak');

        $wypozyczenie2->data_wypozyczenia = $dataWypozyczenia;
        $wypozyczenie2->data_zakonczenia = $dataZakonczenia;

        $wypozyczenie2->pracownik_id = Auth::id();

        $wypozyczenie2->save();

        $hulajnogi = $request->input('hulajnogi');
        $wypozyczenie2->hulajnogi()->attach($hulajnogi);


        $hulajnogi2 = $wypozyczenie->hulajnogi()->pluck('hulajnoga_id')->toArray();
        Hulajnogi::whereIn('id', $hulajnogi2)->update(['zajeta' => 0]);
        $wypozyczenie->forceDelete();

        foreach ($hulajnogi as $hulajnogaId) {
            $hulajnoga = Hulajnogi::find($hulajnogaId);
            $hulajnoga->zajeta = 1;
            $hulajnoga->save();
        }

        return redirect('/wypozyczenia');
    }
}

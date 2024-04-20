<?php

namespace App\Http\Controllers;

use App\Models\Hulajnogi;
use App\Models\Odbiory;
use App\Models\Rewizje;
use App\Models\User;
use App\Models\Wypozyczenia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
class OdbioryController extends Controller
{
    public function index()
    {
        $odbiory = Odbiory::all();
        $users=User::all();
        $hulajnogi=Hulajnogi::all();
        $zajete=Hulajnogi::where('zajeta',1)->get()->toArray();
        $wypozyczenia=Wypozyczenia::all();


        return view('odbiory', compact('odbiory','users','hulajnogi','zajete','wypozyczenia'));
    }
public function calculateRentalCost($dataRozpoczecia, $dataZakonczenia, $hulajnogi)
{
    $dataStart = Carbon::parse($dataRozpoczecia);
    $dataEnd = Carbon::parse($dataZakonczenia);

    // Oblicz różnicę czasu (w godzinach, dniach itp.) między datami
    $czasTrwania = $dataEnd->diffInHours($dataStart); // Możesz użyć innych jednostek, np. diffInDays(), diffInMinutes() itp.

    // Oblicz koszt na podstawie czasu trwania
    $stawkaGodzinowa = 10; // Przykładowa stawka godzinowa
    $kosztWypozyczenia = $stawkaGodzinowa * $czasTrwania * count($hulajnogi);
    return $kosztWypozyczenia;
}
    public function store(Request $request)
    {
        $request->validate([
            'wypozyczenie_id' => 'unique:odbiory'
        ]);

        $wypozyczenieId = $request->input('wypozyczenie_id');
        $wypozyczenie = Wypozyczenia::find($wypozyczenieId);

        if (!$wypozyczenie) {

            return redirect('/odbiory')->with('error', 'Nie można odnaleźć wypożyczenia.');
        }


        if ($wypozyczenie->odebrane) {

            return redirect('/odbiory')->with('error', 'To wypożyczenie zostało już odebrane.');
        }

        $odbior = new Odbiory();
        $odbior->pracownik_id = Auth::id();
        $odbior->wypozyczenie_id = $wypozyczenieId;
        $odbior->klient_id = $wypozyczenie->klient_id;

        $dataRozpoczecia = $wypozyczenie->data_wypozyczenia;
        $dataZakonczenia = $wypozyczenie->data_zakonczenia;
        $kosztWypozyczenia = $this->calculateRentalCost($dataRozpoczecia, $dataZakonczenia, $wypozyczenie->hulajnogi);
        $odbior->koszt_wypozyczenia = $kosztWypozyczenia;

        $odbior->save();


        $wypozyczenie->odebrane = true;
        $wypozyczenie->save();

        $hulajnogi = $wypozyczenie->hulajnogi;
        foreach ($hulajnogi as $hulajnoga) {
            $hulajnoga->zajeta = 0;
            $hulajnoga->save();
        }

        return redirect('/odbiory');
    }

    public function destroy($id)
    {
        $odbior = Odbiory::findOrFail($id);

        $wypozyczenie = Wypozyczenia::where('id', $odbior->wypozyczenie_id)->first();
        $hulajnogi = $wypozyczenie->hulajnogi;

        Wypozyczenia::where('id',$odbior->wypozyczenie_id)->update(['odebrane' => false]);

        foreach ($hulajnogi as $hulajnoga) {
            $hulajnoga->zajeta = 1;
            $hulajnoga->save();
        }

        $odbior->delete();

        return redirect('/odbiory');
    }


}

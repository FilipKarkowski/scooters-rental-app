<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Klienci extends Model
{
    use HasFactory;
    protected $table = 'klienci';
    protected  $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = ['Imie', 'Nazwisko', 'Telefon'];
    protected $dates = ['created_at', 'updated_at'];

     protected static function boot()
    {
        parent::boot();

        // Zdarzenie "created" wywoływane po utworzeniu nowego klienta
        static::created(function ($client) {
            $user = new User();
            $user->name = $client->Imie . " " . $client->Nazwisko;
            // Ustaw inne pola użytkownika według potrzeb
            $user->role = 'client';
            unset($user->email);
            unset($user->password);
            // Zapisz nowego użytkownika
            $user->opis = $client->Telefon;
            $user->save();
        });
    }
}

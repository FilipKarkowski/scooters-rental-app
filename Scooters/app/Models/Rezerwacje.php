<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rezerwacje extends Model
{
    use HasFactory;
    protected $table = 'rezerwacje';
    protected  $primaryKey = 'id';

    protected $fillable = ['klient_id', 'data_rozpoczecia', 'data_zakonczenia', 'placowka_id'];

    public function klient()
    {
        return $this->belongsTo(User::class, 'klient_id');
    }

    public function placowka()
    {
        return $this->belongsTo(Placowki::class, 'placowka_id');
    }

    public function hulajnogi()
    {
        return $this->belongsToMany(Hulajnogi::class, 'rezerwacje_hulajnogi', 'rezerwacja_id', 'hulajnoga_id');
    }
}

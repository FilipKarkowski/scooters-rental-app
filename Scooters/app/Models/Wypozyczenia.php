<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Hulajnogi;


class Wypozyczenia extends Model
{
    use HasFactory;
    protected $table = 'wypozyczenia';
    protected  $primaryKey = 'id';

    protected $fillable = ['klient_id', 'data_rozpoczecia', 'data_zakonczenia','pracownik_id','odebrane'];

    public function klient()
    {
        return $this->belongsTo(User::class, 'klient_id');
    }

    public function pracownik()
    {
        return $this->belongsTo(User::class, 'pracownik_id');
    }

    public function hulajnogi()
    {
        return $this->belongsToMany(Hulajnogi::class, 'wypozyczenia_hulajnogi', 'wypozyczenie_id', 'hulajnoga_id');
    }
    

}


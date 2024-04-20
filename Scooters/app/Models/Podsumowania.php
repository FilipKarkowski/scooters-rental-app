<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Podsumowania extends Model
{
    use HasFactory;
    protected $table = 'podsumowania';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = ['ilosc_wypozyczen', 'wypozyczenie_id', 'ilosc_odbiorow', 'koszt', 'liczba_uszkodzonych', 'odbior_id', 'rewizja_id'];
    protected $dates = ['created_at', 'updated_at'];

    public function wypozyczenie()
    {
        return $this->belongsTo(Wypozyczenia::class,'wypozyczenie_id');
    }

    public function odbior()
    {
        return $this->belongsTo(Odbiory::class,'odbior_id');
    }

    public function rewizja()
    {
        return $this->belongsTo(Rewizje::class,'rewizja_id');
    }

}

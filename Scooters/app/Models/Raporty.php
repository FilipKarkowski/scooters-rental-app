<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Raporty extends Model
{
    use HasFactory;
    protected $table = 'raporty';
    protected  $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = ['data', 'liczba_wypozyczen', 'liczba_odbiorow', 'liczba_uszkodzonych', 'zysk', 'placowka_id', 'odbiory_id', 'rewizje_id', 'wypozyczenia_id'];
    protected $dates = ['created_at', 'updated_at'];

    public function placowka()
    {
        return $this->belongsTo(Placowki::class, 'placowka_id');
    }

    public function odbior()
    {
        return $this->belongsTo(Odbiory::Class, 'odbiory_id');
    }

    public function rewizja()
    {
        return $this->belongsTo(Rewizje::Class, 'rewizje_id');
    }

    public function wypozyczenie()
    {
        return $this->belongsTo(Wypozyczenia::Class, 'wypozyczenia_id');
    }
}

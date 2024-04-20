<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rewizje extends Model
{
    use HasFactory;
    protected $table = 'rewizje';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = ['Data', 'Czy_uszkodzona', 'Opis', 'Koszt_uszkodzen', 'hulajnoga_id'];
    protected $dates = ['created_at', 'updated_at'];

    public function hulajnoga()
    {
        return $this->belongsTo(Hulajnogi::class, 'hulajnoga_id');
    }

    public function placowka()
    {
        return $this->belongsTo(Placowki::class, 'placowka_id');
    }
}

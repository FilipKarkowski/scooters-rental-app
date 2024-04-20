<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hulajnogi extends Model
{
    use HasFactory;
    protected $table = 'hulajnogi';
    protected  $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = ['Nazwa', 'Model', 'placowka_id','zajeta'];
    protected $dates = ['created_at', 'updated_at'];

    public function placowka()
    {
        return $this->belongsTo(Placowki::class, 'placowka_id');
    }
}

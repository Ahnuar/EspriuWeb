<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventosUser extends Model
{
    use HasFactory;
    protected $table = 'eventos_user';
    public function scopeBuscarInscripcio($query,$event,$fill){
        $query->where('eventos_id',$event)
        ->where('hijo_id',$fill);
        return $query->get();
    }
}

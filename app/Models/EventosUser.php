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

    public function scopelistaApuntados($query,$event){
        $query
            ->select('hijos.nombre','hijos.apellidos','hijos.correo','users.name')
            ->join('hijos', 'eventos_user.hijo_id', '=', 'hijos.id')
            ->join('users','eventos_user.user_id','=','users.id')
            ->where('eventos_user.eventos_id',$event);
        return $query->get();
    }
    public function scopeDesasignar($query,$event,$hijo){
        $query
            ->where('eventos_id',$event)
            ->where('hijo_id',$hijo);
        return $query->delete();
    }
}

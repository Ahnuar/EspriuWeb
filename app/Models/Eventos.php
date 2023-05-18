<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Eventos extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo', 'descripcion', 'fecha_inicio', 'fecha_fin', 'lugar', 'url'
    ];

    public function scopeProximos($query)
    {
        return $query
        ->select('eventos.*', DB::raw('COUNT(eventos_user.hijo_id) AS conteo'))
        ->leftJoin('eventos_user', 'eventos.id', '=', 'eventos_user.eventos_id')
        ->where('fecha_hora_evento', '>', now())->orderBy('fecha_hora_evento')
        ->groupBy('eventos.id','eventos.nombre','eventos.descripcion','eventos.url_google_maps','eventos.imagen','eventos.curso','eventos.fecha_hora_evento','eventos.created_at','eventos.updated_at')
        ->get();

    }

    public function scopebuscarpornombre($query,$nombre){
        
        return $query->where('nombre','like',$nombre)->get();
        
    }

    public function getUrlAttribute()
    {
        return route('evento.show', $this->id);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}

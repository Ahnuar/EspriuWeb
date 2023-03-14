<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Eventos extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo', 'descripcion', 'fecha_inicio', 'fecha_fin', 'lugar', 'url'
    ];

    public function scopeProximos($query)
    {
        return $query->where('fecha_hora_evento', '>', now())->orderBy('fecha_hora_evento')->get();
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

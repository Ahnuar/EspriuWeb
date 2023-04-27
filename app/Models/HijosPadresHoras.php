<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HijosPadresHoras extends Model
{
    use HasFactory;
    protected $table = 'hijos_padres_horas';

    
    public function scopeVerHijoHora($query, $idhijo,$fecha,$hora_inicio,$hora_fin){
        return $query->where('idhijo', $idhijo)
                    ->where('fecha', $fecha)
                    ->where('hora_inicio', $hora_inicio)
                    ->where('hora_fin', $hora_fin)
                    ->get();
    }

    public function scopeVerHorasHijo($query, $idpadre){
        $mes_actual = now()->month;

        return
                $query
                    ->selectRaw('hijos_padres_horas.*,horas_acogida.Precio,hijos.nombre,hijos.apellidos,hijos.correo')
                    ->join('hijos','hijos_padres_horas.idhijo', '=', 'hijos.id')
                    ->join('horas_acogida', 'hijos_padres_horas.idhora', '=', 'horas_acogida.id')
                    ->where('hijos_padres_horas.idpadre', $idpadre)
                    ->whereRaw('month(hijos_padres_horas.created_at) = ?', [$mes_actual])
                    ->get();
    }

    public function scopeVerApuntadosPorFecha($query, $fecha){
        return
                $query
                    ->selectRaw('hijos_padres_horas.*,horas_acogida.Precio,hijos.nombre,hijos.apellidos,hijos.correo')
                    ->join('hijos','hijos_padres_horas.idhijo', '=', 'hijos.id')
                    ->join('horas_acogida', 'hijos_padres_horas.idhora', '=', 'horas_acogida.id')
                    ->where('hijos_padres_horas.fecha', $fecha)
                    ->get();
    }
    
    
}

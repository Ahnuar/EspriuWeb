<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HoraAcogida extends Model
{
    use HasFactory;

    protected $fillable = ['hora', 'disponible1'];

    protected $table = 'horas_acogida';

    public function scopeHorasNiu($query){
        $query->join('servicios', 'horas_acogida.idservicio', '=', 'servicios.id')
            ->select('*')
            ->where('servicios.nombre','LIKE', '%NIU%');
        return $query->get();
    }

    public function scopeHoresNiuModificar($query){
        $query->join('servicios', 'horas_acogida.idservicio', '=', 'servicios.id')
            ->select('horas_acogida.*')
            ->where('servicios.nombre','LIKE', '%NIU%');
        return $query->get();
    }

    //ver hora y dia 
    public function scopeHorasNiuDia($query, $dia, $hora,$hora_fin){

        $dia_semana_numero = date('N', strtotime($dia));
        $query
            ->select('*')
            ->where('hora_inicio','=', $hora)
            ->where('dia_semana','=' ,$dia_semana_numero)
            ->where('hora_fin','=', $hora_fin);
        return $query->get();
    }

    public function scopebuscarhoresDia($query, $dia){
        $query->join('servicios', 'horas_acogida.idservicio', '=', 'servicios.id')
        ->select('horas_acogida.*')
        ->where('servicios.nombre','LIKE', '%NIU%',)
        ->where('horas_acogida.dia_semana','=',$dia);
        return $query->get();
    }


    public function scopeVerHorasNiu($query){
        $query->join('servicios', 'horas_acogida.idservicio', '=', 'servicios.id')
        ->select('horas_acogida.hora_inicio', 'horas_acogida.hora_fin', 'servicios.fecha_fin')
        ->distinct()
        ->where('servicios.nombre', 'LIKE', '%NIU%');
        return $query->get();

    }


}


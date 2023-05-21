<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

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

    public function scopeVerHorasHijo($query,$idpadre,$mes){

        return
                $query
                    ->selectRaw('hijos_padres_horas.*,horas_acogida.Precio,hijos.nombre,hijos.apellidos,hijos.correo')
                    ->join('hijos','hijos_padres_horas.idhijo', '=', 'hijos.id')
                    ->join('horas_acogida', 'hijos_padres_horas.idhora', '=', 'horas_acogida.id')
                    ->where('hijos_padres_horas.idpadre',$idpadre)
                    ->whereRaw('MONTH(hijos_padres_horas.fecha) = ?', [$mes])
                    ->get();
    }

    public function scopeVerApuntadosPorFecha($query, $fecha){
        return
                $query
                    ->selectRaw('hijos_padres_horas.*,horas_acogida.Precio,hijos.nombre,hijos.apellidos,hijos.correo')
                    ->join('hijos','hijos_padres_horas.idhijo', '=', 'hijos.id')
                    ->join('horas_acogida', 'hijos_padres_horas.idhora', '=', 'horas_acogida.id')
                    ->where('hijos_padres_horas.fecha',$fecha)
                    ->get();
    }

    public function scopeVerApuntadosGlobales($query, $idpadre, $idhijo){
        return
            $query
                ->select('*')
                ->where('idhijo', $idhijo)
                ->get();
    }

    public function scopeVerApuntadosPorFechaAgrupados($query, $mes){
        $query = DB::table('hijos_padres_horas')
        ->select('users.name', 'hijos.nombre', 'hijos.apellidos', 'hijos.correo', DB::raw('SUM(horas_acogida.Precio) as total'))
        ->join('hijos', 'hijos_padres_horas.idhijo', '=', 'hijos.id')
        ->join('horas_acogida', 'hijos_padres_horas.idhora', '=', 'horas_acogida.id')
        ->join('users', 'hijos_padres_horas.idpadre', '=', 'users.id')
        ->whereMonth('hijos_padres_horas.created_at', $mes)
        ->groupBy('users.name', 'hijos_padres_horas.idhijo', 'hijos.nombre', 'hijos.apellidos', 'hijos.correo')
        ->get();
        return $query;

    }

    public function scopeVerHorasSiguientesHorasNoPeriodicas($query,$idpadre){
        //de las proximas fechas 
        return $query -> select('hijos_padres_horas.fecha', 'hijos_padres_horas.hora_inicio', 'hijos_padres_horas.hora_fin','hijos.nombre','hijos.id')
        ->join('hijos', 'hijos_padres_horas.idhijo', '=', 'hijos.id')
        ->where('hijos_padres_horas.idpadre',$idpadre)
        ->where('hijos_padres_horas.fecha','>=',Carbon::now()->toDateString())
        ->where('hijos_padres_horas.hora_inicio','>=',Carbon::now()->toTimeString())
        ->where('hijos_padres_horas.casual',"=",1)
        ->get();
        ;        
    }
    
    
}

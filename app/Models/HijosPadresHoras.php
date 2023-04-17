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
    
    
}

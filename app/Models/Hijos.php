<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\HijosPadres;
class Hijos extends Model
{
    use HasFactory;

    protected $table = 'hijos';

    public function scopeIndex($query){
        return $query->get();
    }

    public function scopeHijosPadres($query, $id)
    {
        $query->join('hijos_padres', 'hijos_padres.hijos_id', '=', 'hijos.id')
            ->select('hijos.*')
            ->where('hijos_padres.user_id', $id);
        return $query->get();
    }
    public function scopebuscarNen($query, $correo){
        return $query->select('*')->where('correo',$correo)->get();
    }

    public function scopebuscarHijoAsignado($query, $idpare,$idfill){
        $query->join('hijos_padres', 'hijos_padres.hijos_id', '=', 'hijos.id')
        ->select('hijos.*')
        ->where('hijos_padres.user_id', $idpare)
        ->where('hijos_padres.hijos_id', $idfill);
        return $query->get();
    }
}
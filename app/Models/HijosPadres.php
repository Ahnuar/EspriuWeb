<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HijosPadres extends Model
{
    use HasFactory;
    protected $table = 'hijos_padres';

    public function scopebuscarHijoAsignado($query, $idpare,$idfill){
        $query
        ->select('*')
        ->where('user_id', $idpare)
        ->where('hijos_id', $idfill);
        return $query->get();
    }

    public function scopeDesasignar($query, $idpare,$idfill){
        $query
        ->where('user_id', $idpare)
        ->where('hijos_id', $idfill);
        return $query->delete();
    }    
}

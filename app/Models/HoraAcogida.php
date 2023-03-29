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

}


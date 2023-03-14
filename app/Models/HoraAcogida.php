<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HoraAcogida extends Model
{
    use HasFactory;

    protected $fillable = ['hora', 'disponible'];

    protected $table = 'horas_acogida';


}


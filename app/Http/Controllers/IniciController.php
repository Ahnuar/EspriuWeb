<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Eventos;

class IniciController{

    public function index(){
        $dades['eventos'] = Eventos::Proximos();
        return view('inici',$dades);
    }

}
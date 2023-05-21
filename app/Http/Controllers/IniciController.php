<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Eventos;

class IniciController{

    public function index(){
        $user=auth()->user();
        if($user){
        if($user["admin"]==1){
            $dades["admin"]=true;
        }

        if($user["monitor"]==1){
            $dades["monitor"]=true;
        }
    }else{
        $dades["admin"]=false;
        $dades["monitor"]=false;
    }
        $dades['eventos'] = Eventos::Proximos();
        return view('inici',$dades);
    }



}
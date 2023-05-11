<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Eventos;
use App\Models\Hijos;
use App\Models\HijosPadres;
use Illuminate\Http\Request;

class HomeController extends Controller
{
   
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $dades["admin"]=false;
        $dades["monitor"]=false;
        
        $user=auth()->user();
        
        if($user["admin"]==1){
            $dades["admin"]=true;
        }

        if($user["monitor"]==1){
            $dades["monitor"]=true;
        }

        $dades["eventos"] = Eventos::Proximos();

        $dades["hijosPropios"] = Hijos::HijosPadres($user["id"]);
        return view('home', $dades);
    }

    public function assignarHijo(Request $request){
        $user=auth()->user();
        $dades["admin"]=false;
        $dades["monitor"]=false;
        
        $email = $request->email;
        if($user["admin"]==1){
            $dades["admin"]=true;
        }

        if($user["monitor"]==1){
            $dades["monitor"]=true;
        }

        $dades["success"]=false;
        $dades["nomuser"]=$email;
        $hijo= Hijos::buscarNen($email);
        if(count($hijo)>0){
            $hijosasignados = Hijos::buscarHijoAsignado($user["id"],$hijo[0]["id"]);
            if(count($hijosasignados)==0){
            
            $fillAmbPare = new HijosPadres();
            $fillAmbPare["hijos_id"]=$hijo[0]["id"];
            $fillAmbPare["user_id"]=$user->id;
            $fillAmbPare->save();
            $dades["success"]=true;
            
            }
            $dades["fillAssignat"]=$hijo[0]["nombre"];
        }
        
        $dades["hijosPropios"] = Hijos::HijosPadres($user["id"]);
        return view('home', $dades);
    }

}

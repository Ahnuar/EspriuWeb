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

        $dades["hijos"] = Hijos::HijosPadres($user["id"]);
        return view('home', $dades);
    }

    public function insertarFill(Request $request){
        $dades["admin"]=false;
        $dades["monitor"]=false;
        
        $user=auth()->user();
        
        if($user["admin"]==1){
            $dades["admin"]=true;
        }

        if($user["monitor"]==1){
            $dades["monitor"]=true;
        }
        if($request->nombre != "" && $request->apellidos!="" && $request->correo!=""){
            $fill = new Hijos();
            $fill["nombre"] = $request->nombre;
            $fill["apellidos"] = $request->apellidos;
            $fill["correo"] = $request->correo;
            $fill->save();

            $fillAmbPare = new HijosPadres();
            $fillAmbPare["hijos_id"]=$fill->id;
            $fillAmbPare["user_id"]=$user->id;
            $fillAmbPare->save();

            $dades["creado"]=true;
            $dades["fillInsertat"] = $fill["nombre"];
        }else{
            $dades["creado"]=false;
        }


        $dades["eventos"] = Eventos::Proximos();

        $dades["hijos"] = Hijos::HijosPadres($user["id"]);
        return view('home',$dades);
    }
}

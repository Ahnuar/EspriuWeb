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
        $dades["hijos"] = Hijos::Nens($user["id"]);

        return view('home', $dades);
    }

    public function assignarHijo(Request $request){
        $user=auth()->user();
        $dades["admin"]=false;
        $dades["monitor"]=false;     
        if($user["admin"]==1){
            $dades["admin"]=true;
        }

        if($user["monitor"]==1){
            $dades["monitor"]=true;
        }

        $fillAmbPare = new HijosPadres();
        $fillAmbPare["hijos_id"]=$request->nenSelected;
        $fillAmbPare["user_id"]=$user->id;
        $fillAmbPare->save();

        $dades["hijosPropios"] = Hijos::HijosPadres($user["id"]);
        $dades["hijos"] = Hijos::Nens($user["id"]);
        return view('home', $dades);
    }

}

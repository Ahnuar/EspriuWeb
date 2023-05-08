<?php

namespace App\Http\Controllers;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Http\Request;
use App\Models\Eventos;
use App\Models\Hijos;
use App\Models\EventosUser;

class EventosController extends Controller
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
        $user=auth()->user();
        $dades['eventos'] = Eventos::Proximos();
        $dades['hijos'] = Hijos::HijosPadres($user["id"]);
    
        return view('eventos/detall',$dades);
    }


    public function signup(Request $request)
    {
        $user=auth()->user();
        $inscripcions =EventosUser::BuscarInscripcio($request->idEvento,$request->selectHijo);
        $Hijo = Hijos::find($request->selectHijo);
        $dades["fillInscrit"]=$Hijo["nombre"];
        $dades["eventoInscrito"]=$request->idEvento;
        $dades["success"]=false;
        if(count($inscripcions)==0){
            $inscripcio = new EventosUser();
            
            $inscripcio["eventos_id"] = $request->idEvento;
            $inscripcio["user_id"] = $user["id"];
            $inscripcio["hijo_id"] = $request->selectHijo;
            $inscripcio->save();
            $dades["success"]=true;
        }
        $dades['eventos'] = Eventos::Proximos();
        $dades['hijos'] = Hijos::HijosPadres($user["id"]);

        return view('eventos/detall',$dades);
    }

}

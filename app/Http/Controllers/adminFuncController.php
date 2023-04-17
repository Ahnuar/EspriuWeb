<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Eventos;
use Illuminate\Http\Request;

class adminFuncController extends Controller
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

        return view('adminfunc/gestioneventos', $dades);
    }

    public function mostrarviewmonitores(){
        return view('adminfunc/gestiondemonitores');
    }

    public function hacermonitor(Request $request){
        $user=auth()->user();
        $email = $request->email;
        $dades["monitor"]=$user["monitor"];
        $dades["admin"]=$user["admin"];

        $dades["success"]=false;
        $dades["nomuser"]=$email;
        $dades["eventos"] = Eventos::Proximos();
        $usuario= User::buscaruser($email);
        if($user["admin"==1]){
            if(!Count($usuario)==0){
                if($usuario[0]["monitor"]==0){
                    
                    $dades["success"] = User::hacermonitor($usuario[0]['email']);
                    $dades["monitoruser"] = true;
                    $dades["nomuser"] = $usuario["name"];
                }
            }
        }

        return view('adminfunc/gestiondemonitores', $dades);
    }

    public function buscarEvento(Request $request){
        $evento = Eventos::find($request->nombreEvento);
        $dades["trobat"]=true;
        $user=auth()->user();
        $dades["monitor"]=$user["monitor"];
        $dades["admin"]=$user["admin"];
        $dades["eventoSelected"]=$evento;
    
        $dades["eventos"] = Eventos::Proximos();
        return view('adminfunc/gestioneventos',$dades);
    }

    public function mostrarTodos(Request $request){
        $user=auth()->user();
        $dades["monitor"]=$user["monitor"];
        $dades["admin"]=$user["admin"];

        $dades["tots"] = true;
        $dades["eventos"] = Eventos::Proximos();
        return view('adminfunc/gestioneventos',$dades);
    }

    public function modificarevento(Request $request){
        $evento = Eventos::find($request->id);
        $evento["nombre"] = $request->nombre;
        $evento["descripcion"] = $request->desc;
        $evento["fecha_hora_evento"] = $request->data;
        $evento->save();

        $user=auth()->user();
        $dades["monitor"]=$user["monitor"];
        $dades["admin"]=$user["admin"];
        $dades["modificat"]=true;
        $dades["eventAlterat"] = $evento["nombre"];

        $dades["eventos"] = Eventos::Proximos();
        return view('adminfunc/gestioneventos',$dades);
    }

    public function insertarEvento(Request $request){
        $user=auth()->user();
        $dades["monitor"]=$user["monitor"];
        $dades["admin"]=$user["admin"];
        
        if($request->nombre != "" && $request->desc!="" && $request->url !="" && $request->curs!=""){
            $evento = new Eventos();
            $evento["nombre"] = $request->nombre;
            $evento["descripcion"] = $request->desc;
            $evento["fecha_hora_evento"] = $request->data;
            $evento["url_google_maps"] = $request->url;
            $evento["curso"] = $request->curs;
            $evento->save();
    
            $dades["creado"]=true;
            $dades["eventInsertat"] = $evento["nombre"];
        }else{
            $dades["creado"]=false;
        }


        $dades["eventos"] = Eventos::Proximos();
        return view('adminfunc/gestioneventos',$dades);
        }
    
        public function eliminarEvento(Request $request){
            $user=auth()->user();
            $dades["monitor"]=$user["monitor"];
            $dades["admin"]=$user["admin"];
            
            $evento = Eventos::find($request->id);
            $dades["eventoEliminado"] = $evento["nombre"];
            $evento->delete();
            $dades["eliminado"]=true;
            $dades["eventos"] = Eventos::Proximos();
            return view('adminfunc/gestioneventos',$dades);
        }
}
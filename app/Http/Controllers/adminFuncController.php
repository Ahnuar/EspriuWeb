<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Eventos;
use App\Models\HoraAcogida;
use Illuminate\Http\Request;
use App\Models\Hijos;

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

    public function mostrarviewusers(){
        $dades["privilegiats"]=User::index();
        return view('adminfunc/gestiousers',$dades);
    }

    public function mostrarViewGestioFills(){
        $dades["Infants"]=Hijos::index();
        return view('adminfunc/gestionhijos', $dades);
    }

    public function mostrarViewGestioNiu(){
        $dades["horas"] = HoraAcogida::HoresNiuModificar();
        return view('adminfunc/gestionniu',$dades);
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
        if($user["admin"]){
            if(count($usuario)>0){
                if($usuario[0]["monitor"]==0){

                    $dades["success"] = User::hacermonitor($usuario[0]['email']);
                    $dades["monitoruser"] = true;
                    
                }
            }
        }
        $dades["privilegiats"]=User::index();
        return view('adminfunc/gestiousers', $dades);
    }
    public function quitarMonitor(Request $request){
        $user=auth()->user();
        $email = $request->email;
        $dades["monitor"]=$user["monitor"];
        $dades["admin"]=$user["admin"];

        $dades["desprivilegiat"]=false;
        $dades["nomuser"]=$email;
        $dades["eventos"] = Eventos::Proximos();
        $usuario= User::buscaruser($email);
        if($user["admin"]){
            if(count($usuario)>0){
                if($usuario[0]["monitor"]==1){
                    
                    $dades["desprivilegiat"] = User::quitarMonitor($usuario[0]['email']);
                    $dades["monitoruser"] = true;
                    
                }
            }
        }
        $dades["privilegiats"]=User::index();
        return view('adminfunc/gestiousers', $dades);
    }
    public function haceradmin(Request $request){
        $user=auth()->user();
        $email = $request->email;
        $dades["monitor"]=$user["monitor"];
        $dades["admin"]=$user["admin"];

        $dades["successA"]=false;
        $dades["nomuser"]=$email;
        $dades["eventos"] = Eventos::Proximos();
        $usuario= User::buscaruser($email);
        
        if($user["admin"]){
            if(count($usuario)!=0){
                if($usuario[0]["admin"]==0){
                    
                    $dades["successA"] = User::haceradmin($usuario[0]['email']);
                    $dades["monitoruser"] = true;
                    
                }
            }
        }
        $dades["privilegiats"]=User::index();
        return view('adminfunc/gestiousers', $dades);
    }
    public function quitaradmin(Request $request){
        $user=auth()->user();
        $email = $request->email;
        $dades["monitor"]=$user["monitor"];
        $dades["admin"]=$user["admin"];

        $dades["desprivilegiatA"]=false;
        $dades["nomuser"]=$email;
        $dades["eventos"] = Eventos::Proximos();
        $usuario= User::buscaruser($email);
        if($user["admin"]){
            if(count($usuario)>0){
                if($usuario[0]["admin"]==1){
                    
                    $dades["desprivilegiatA"] = User::quitaradmin($usuario[0]['email']);
                    $dades["monitoruser"] = true;
                    
                }
            }
        }
        $dades["privilegiats"]=User::index();
        return view('adminfunc/gestiousers', $dades);
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

    public function buscarHorasXDia(Request $request){
       
        $horas = HoraAcogida::buscarhoresDia($request->diaSelected);
        if(count($horas)>0){
            $dades["horesXDia"]=$horas;
            $dades["trobat"]=true;
        }
        
        $user=auth()->user();
        $dades["monitor"]=$user["monitor"];
        $dades["admin"]=$user["admin"];
        $dades["diaPreselected"]=$request->diaSelected;
    
        //$dades["horas"] = HoraAcogida::HoresNiuModificar();
        return view('adminfunc/gestionniu',$dades);
    }

    public function buscarHora(Request $request){
        $hora = HoraAcogida::find($request->horaSelected);
        $dades["horaSelected"] = $hora;
        $dades["horaTrobada"]=true;

        $user=auth()->user();
        $dades["monitor"]=$user["monitor"];
        $dades["admin"]=$user["admin"];

        $dades["diaPreselected"]=$hora["dia_semana"];
        $horas = HoraAcogida::buscarhoresDia($request->diaselected);
        $dades["horesXDia"]=$horas;
        $dades["trobat"]=true;
        return view('adminfunc/gestionniu',$dades);
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
        $evento["url_google_maps"] = str_replace('width="600" height="450"','width="100%"',$request->url);
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


    //mas tarde
    public function modificarHora(Request $request){
        $hora = HoraAcogida::find($request->id);
        $hora["hora_inicio"] = $request->horaInici;
        $hora["hora_fin"] = $request->horaFinal;
        $hora["Precio"] = $request->preu;
        $hora->save();

        $user=auth()->user();
        $dades["monitor"]=$user["monitor"];
        $dades["admin"]=$user["admin"];
        $dades["modificat"]=true;
        switch ($hora["dia_semana"]) {
            case 1:
                $dades["horaModificada"]="Dilluns ".$hora["hora_inicio"] . " - " . $hora["hora_fin"];
                break;
            case 2:
                $dades["horaModificada"]="Dimarts ".$hora["hora_inicio"] . " - " . $hora["hora_fin"];
                break;
            case 3:
                $dades["horaModificada"]="Dimecres ".$hora["hora_inicio"] . " - " . $hora["hora_fin"];
                break;
            case 4:
                $dades["horaModificada"]="Dijous ".$hora["hora_inicio"] . " - " . $hora["hora_fin"];
                break;
            case 5:
                $dades["horaModificada"]="Divendres ".$hora["hora_inicio"] . " - " . $hora["hora_fin"];
                break;
          }
        

        return view('adminfunc/gestionniu',$dades);
    }

    public function eliminarHora(Request $request){
        $hora = HoraAcogida::find($request->id);
        $hora->delete();

        $user=auth()->user();
        $dades["monitor"]=$user["monitor"];
        $dades["admin"]=$user["admin"];
        $dades["eliminat"]=true;
        switch ($hora["dia_semana"]) {
            case 1:
                $dades["horaEliminada"]="Dilluns ".$hora["hora_inicio"] . " - " . $hora["hora_fin"];
                break;
            case 2:
                $dades["horaEliminada"]="Dimarts ".$hora["hora_inicio"] . " - " . $hora["hora_fin"];
                break;
            case 3:
                $dades["horaEliminada"]="Dimecres ".$hora["hora_inicio"] . " - " . $hora["hora_fin"];
                break;
            case 4:
                $dades["horaEliminada"]="Dijous ".$hora["hora_inicio"] . " - " . $hora["hora_fin"];
                break;
            case 5:
                $dades["horaEliminada"]="Divendres ".$hora["hora_inicio"] . " - " . $hora["hora_fin"];
                break;
          }
        

        return view('adminfunc/gestionniu',$dades);
    }

    //acabar funcion
    public function insertarHora(Request $request){
        $user=auth()->user();
        $dades["monitor"]=$user["monitor"];
        $dades["admin"]=$user["admin"];
    
        $hora = new HoraAcogida();
        $hora["dia_semana"] = $request->diaSelected;
        $hora["idservicio"] = 1;
        $hora["hora_inicio"] = $request->horaInici;
        $hora["hora_fin"] = $request->horaFinal;
        $hora["Precio"] = $request->preu;

        $hora->save();
        $dades["insertat"]=true;
        switch ($hora["dia_semana"]) {
            case 1:
                $dades["horaInsertada"]="Dilluns ".$hora["hora_inicio"] . " - " . $hora["hora_fin"];
                break;
            case 2:
                $dades["horaInsertada"]="Dimarts ".$hora["hora_inicio"] . " - " . $hora["hora_fin"];
                break;
            case 3:
                $dades["horaInsertada"]="Dimecres ".$hora["hora_inicio"] . " - " . $hora["hora_fin"];
                break;
            case 4:
                $dades["horaInsertada"]="Dijous ".$hora["hora_inicio"] . " - " . $hora["hora_fin"];
                break;
            case 5:
                $dades["horaInsertada"]="Divendres ".$hora["hora_inicio"] . " - " . $hora["hora_fin"];
                break;
          }
        return view('adminfunc/gestionniu',$dades);
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
            $evento["url_google_maps"] = str_replace('width="600" height="450"','width="100%"',$request->url);
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

        public function insertarFill(Request $request){
            $dades["admin"]=false;
            $dades["monitor"]=false;
            
            $user=auth()->user();
            $dades["Infants"]=Hijos::index();
            if($user["admin"]==1){
                $dades["admin"]=true;
            }
    
            if($user["monitor"]==1){
                $dades["monitor"]=true;
            }
            $dades["creado"]=false;
            if($request->nombre != "" && $request->apellidos!="" && $request->correo!=""){
                $fill = new Hijos();
                $fill["nombre"] = $request->nombre;
                $fill["apellidos"] = $request->apellidos;
                $fill["correo"] = $request->correo;
                if(Count(Hijos::buscarNen($fill["correo"]))==0){
                    
                    $fill->save();
        
                    $dades["creado"]=true;
                }

                $dades["fillInsertat"] = $fill["nombre"];
            }
    
            $dades["Infants"]=Hijos::index();
            $dades["eventos"] = Eventos::Proximos();
            return view('adminfunc/gestionhijos',$dades);
        }
}
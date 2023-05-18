<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Eventos;
use App\Models\Hijos;
use App\Models\HijosPadres;
use App\Models\HijosPadresHoras;
use Illuminate\Http\Request;
use League\Csv\Writer;

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
        $dades["usuario"]=$user;
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
        $dades["usuario"]=$user;
        $dades["hijosPropios"] = Hijos::HijosPadres($user["id"]);
        return view('home', $dades);
    }

    
    public function desassignarHijo(Request $request){
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

        $dades["aconseguit"]=false;
        $dades["nomuser"]=$email;
        $hijo= Hijos::buscarNen($email);
        if(count($hijo)>0){
            $hijosasignados = Hijos::buscarHijoAsignado($user["id"],$hijo[0]["id"]);
            if(count($hijosasignados)!=0){
                $hijosasignadoshoras=HijosPadresHoras::VerApuntadosGlobales($user["id"],$hijo[0]["id"]);
                if(count($hijosasignadoshoras)==0){
                    $hijosasignados[0]->delete();
                    $dades["aconseguit"]=true;
                } else{
                    $dades["fillAlNiu"]=true;
                }           
            }
            $dades["filldesAssignat"]=$hijo[0]["nombre"];
        }
        $dades["usuario"]=$user;
        $dades["hijosPropios"] = Hijos::HijosPadres($user["id"]);
        return view('home', $dades);
    }

    public function exportar(Request $request){

    $user=auth()->user();
    $dades["admin"]=false;
    $dades["monitor"]=false;

    if($user["admin"]==1){
        $dades["admin"]=true;
    }

    if($user["monitor"]==1){
        $dades["monitor"]=true;
    }
    $dades["exportat"]=false;
    $resultados = HijosPadresHoras::VerApuntadosPorFechaAgrupados($request->mes);
    if(count($resultados)!=0){
        // Crear el objeto Writer
        $csv = Writer::createFromPath(getenv('USERPROFILE') . DIRECTORY_SEPARATOR . 'Desktop'.'\Facturacio.csv', 'w');

        // Escribir los encabezados
        $csv->insertOne(['Nom Usuari', 'Nom Infant', 'Cognoms Infant', 'Correo Infant', 'Total Preu']);

        // Escribir los datos de cada resultado
    // Escribir los datos de cada resultado
    foreach ($resultados as $resultado) {
        $csv->insertOne([
            $resultado->name,
            $resultado->nombre,
            $resultado->apellidos,
            $resultado->correo,
            $resultado->total
        ]);
    }

    // Eliminar las comillas alrededor de cada valor
    $csv->setEnclosure('"');

        $dades["exportat"]=true;
    }
        $dades["usuario"]=$user;
        $dades["hijosPropios"] = Hijos::HijosPadres($user["id"]);
        return view('home',$dades);
    }
}

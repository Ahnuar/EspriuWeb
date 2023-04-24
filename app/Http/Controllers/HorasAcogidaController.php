<?php

namespace App\Http\Controllers;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Http\Request;
use App\Models\Eventos;
use App\Models\Hijos;
use App\Models\HoraAcogida;
use App\Models\HijosPadres;
use App\Models\HijosPadresHoras;

class HorasAcogidaController extends Controller
{
    public function index()
    {
        $fechas = HoraAcogida::HorasNiu();
        $eventHoras = null;
        if(count($fechas)!=0){
            $eventHoras = self::horas($fechas);
        }
        $hijos = Hijos::HijosPadres(auth()->user()->id);
        
        return view('niu.detall', compact('fechas', 'hijos','eventHoras'));
    }
    
    private function horas($fechas=null){
        if($fechas[0]->fecha_fin>=now()){
            $cont=0;
            $contDIAS=0;
            $contadorEventos=0;
            $flag =false;
            while($contDIAS!=20){
                $date = strtotime("+$cont day");
                $date_str = date('Y-m-d', strtotime("+$cont day"));
                $dia = date("Y-M-D", $date);
                $dateNUM= date("w", $date);
                if($dateNUM != 0 || $dateNUM !=6){
                    foreach($fechas as $hora){
                        $horaselec= $date_str." ".$hora->hora_inicio;
                        if($horaselec>now()){
                            if($hora->dia_semana == $dateNUM){
                                $eventHoras[] = [
                                    /*'title' => $hora->hora_inicio. " - " . $hora->hora_fin,*/
                                    'title' => "NIU - ".$hora->hora_fin ,
                                    'start' =>$date_str." ".$hora->hora_inicio,
                                    'end' =>$date_str." ". $hora->hora_fin,
                                    'id' => $contadorEventos,
                                ];
                                $flag = true;
                                $contadorEventos++;
                            }
                        }
                    }
                    if($flag){
                        $contDIAS++;
                        $flag = false;
                    }
                } 
                $cont++;
            }
        }

        return $eventHoras;
    }




    public function show(Request $request){
        $fechas = HoraAcogida::HorasNiu();
        $eventHoras = self::horas($fechas);

        $hijos = Hijos::HijosPadres(auth()->user()->id);
        $id = $request->query("id");
        return view('niu.apuntar',compact('eventHoras','id','fechas','hijos'));
    }


    public function apuntar(Request $request)
    {
    
        $request->validate([
            'hijo' => 'required|exists:hijos_Padres,hijos_id,user_id,' . auth()->user()->id
        ]);
        try{
            $horaElegida = explode(" ",$request->hora)[1];
            $finhoraElegida = explode(" ",$request->hora)[2];
            $diaElegido = explode(" ",$request->hora)[0];
            $hora = HoraAcogida::HorasNiuDia($diaElegido,$horaElegida, $finhoraElegida);
            if($hora == null){
                return back()->withErrors(['message' => 'No se ha encontrado la hora.']);
            }
        
            $hijoapuntado = HijosPadresHoras::VerHijoHora($request->hijo,$diaElegido,$horaElegida, $finhoraElegida);
            
            if (count($hijoapuntado) > 0) {
                return back()->withErrors(['message' => 'Este hijo ya está apuntado a esa hora.']);
            }
            
            $hijosPadresHoras = new HijosPadresHoras();
            $hijosPadresHoras->idhijo = $request->hijo;
            $hijosPadresHoras->idpadre = auth()->user()->id;
            $hijosPadresHoras->idhora = $hora[0]->id;
            $hijosPadresHoras->servicio = "NIU";
            $hijosPadresHoras->fecha = $diaElegido;
            $hijosPadresHoras->hora_inicio = $horaElegida;
            $hijosPadresHoras->hora_fin = $finhoraElegida;
            $hijosPadresHoras->save();

        }catch(\Exception $e){

        }


        
/*         $hora->hijos()->attach($request->hijo, ['user_id' => auth()->user()->id]);
 */    
        return redirect()->route('niu.index')->with('success', 'Hijo apuntado correctamente.');
    }

}

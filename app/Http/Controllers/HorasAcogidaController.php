<?php

namespace App\Http\Controllers;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Http\Request;
use App\Models\Eventos;
use App\Models\Hijos;
use App\Models\HoraAcogida;
use App\Models\HijosPadres;
use App\Models\HijosPadresHoras;
use DateTime;

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



    public function apuntarPeriodico(Request $request){
        $request->validate([
            'hijo' => 'required|exists:hijos_padres,hijos_id,user_id,' . auth()->user()->id
        ]);

        // Fecha de inicio y fin en formato 'Y-m-d'
        $diaActual = date('N'); // Obtiene el número del día de la semana (1 al 7)

        if ($diaActual >= 6) {
        // Si es sábado (6) o domingo (7)
            $diaActual = strtotime('next Monday'); // Obtiene la fecha del próximo lunes
        }else{
            $diaActual = strtotime('today'); // Obtiene la fecha de hoy
        }
        $diaLaborableSiguiente = date('Y-m-d', $diaActual); // Formatea la fecha al formato deseado (Año-Mes-Día)


        $fechaInicio = $diaLaborableSiguiente;
        $hora = json_decode($request['hora']); // Decodificar la cadena JSON en un objeto
        //dd($request->all());
        $fechaFin = $hora->fecha_fin;


        $inicio = strtotime($fechaInicio);
        $fin = strtotime($fechaFin);

        // Convertir las fechas a objetos DateTime
        $inicio = new DateTime($fechaInicio);
        $fin = new DateTime($fechaFin);


        $error="";
        // Iterar desde la fecha de inicio hasta la fecha de fin
        while ($inicio <= $fin) {

            if ($inicio->format('N') <= 5) {
                try{

                    $registroExistente = HijosPadresHoras::where([
                        'idhijo' => $request->hijo,
                        'idpadre' => auth()->user()->id,
                        'idhora' => $hora->id,
                        'servicio' => "NIU",
                        'fecha' => $inicio->format('Y-m-d'),
                        'hora_inicio' => $hora->hora_inicio,
                        'hora_fin' => $hora->hora_fin,
                    ])->exists();
                    
                    if ($registroExistente) {
                        // El registro ya existe en la base de datos
                        //$error =$error ."\n El dia ".$inicio->format('Y-m-d')." a ".$hora->hora_inicio."-".$hora->hora_fin. " ya esta apuntado. ";
                    } else {
                        // El registro no existe, puedes guardarlo
                        $hijosPadresHoras = new HijosPadresHoras();
                        $hijosPadresHoras->idhijo = $request->hijo;
                        $hijosPadresHoras->idpadre = auth()->user()->id;
                        $hijosPadresHoras->idhora = $hora->id;
                        $hijosPadresHoras->servicio = "NIU";
                        $hijosPadresHoras->fecha = $inicio->format('Y-m-d');
                        $hijosPadresHoras->hora_inicio = $hora->hora_inicio;
                        $hijosPadresHoras->hora_fin = $hora->hora_fin;
                        $hijosPadresHoras->save();
                    
                        echo "El registro ha sido creado.";
                    }
                }catch(Exception $e){
                    return back()->withErrors(['message' => 'No se ha encontrado la hora.']);
                }
            }

            $inicio->modify('+1 day');
        }

        return redirect()->route('niu.index')->with('success', 'Infants apuntats correctament. Veure Facturació');
    }




    public function show(Request $request){
        $fechas = HoraAcogida::HorasNiu();
        $eventHoras = self::horas($fechas);

        $hijos = Hijos::HijosPadres(auth()->user()->id);
        $id = $request->query("id");

        $horas = HoraAcogida::VerHorasNiu();
        
        return view('niu.apuntar',compact('eventHoras','id','fechas','hijos','horas'));
    }


    public function apuntar(Request $request)
    {
    
        $request->validate([
            'hijo' => 'required|exists:hijos_padres,hijos_id,user_id,' . auth()->user()->id
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

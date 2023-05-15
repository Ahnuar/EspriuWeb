<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Eventos;
use App\Models\HijosPadresHoras;

class facturacioController extends Controller{

    public function index(){
        $mes_actual = now()->month;
        $facturacio = HijosPadresHoras::VerHorasHijo(auth()->user()->id,$mes_actual);
        $dades['facturacio']=null;
        if(count($facturacio) > 0)
        {
            $total = 0;
            foreach($facturacio as $factura)
            {
                $factura->fecha = date('d-m-Y', strtotime($factura->fecha));
            }
            $dades['facturacio'] = $facturacio;
        }

        return view('/pagos/facturacio', $dades['facturacio']);
    }
    
    public function obtenerFacturacion($mes){
        $idpadre = auth()->user()->id;
        $facturacio = HijosPadresHoras::VerHorasHijo($idpadre,$mes);
        $dades['facturacio']=null;
        if(count($facturacio) > 0)
        {
            $total = 0;
            foreach($facturacio as $factura)
            {
                $factura->fecha = date('d-m-Y', strtotime($factura->fecha));
            }
            $dades['facturacio'] = $facturacio;
            
        }
    
        return response()->json($facturacio);
    }

    public function lista(){
        $user=auth()->user();

        if($user["monitor"]==1 || $user["admin"]==1){
            $facturacio = HijosPadresHoras::VerApuntadosPorFecha(date('Y-m-d'));
        
            if(count($facturacio) > 0)
            {
                $total = 0;
                foreach($facturacio as $factura)
                {
                    $factura->fecha = date('d-m-Y', strtotime($factura->fecha));
                }
                $dades['facturacio'] = $facturacio;
            }else{
                $dades['facturacio'] = null;
            }
            //$dades["eventHoras"]=
            return view('/pagos/lista',$dades);
        }else{
            return redirect('/home');
        }
        
    }


}
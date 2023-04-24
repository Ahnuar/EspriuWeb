<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Eventos;
use App\Models\HijosPadresHoras;

class facturacioController extends Controller{

    public function index(){

        $facturacio = HijosPadresHoras::VerHorasHijo(auth()->user()->id);

        if(count($facturacio) > 0)
        {
            $total = 0;
            foreach($facturacio as $factura)
            {
                $factura->fecha = date('d-m-Y', strtotime($factura->fecha));
            }
            $dades['facturacio'] = $facturacio;
        }

        return view('/pagos/facturacio',$dades);
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
    
            return view('/pagos/lista',$dades);
        }else{
            return redirect('/home');
        }
        
    }

}
<?php

namespace App\Http\Controllers;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Http\Request;
use App\Models\Eventos;
use App\Models\Hijos;
use App\Models\HoraAcogida;
use App\Models\HijosPadres;

class HorasAcogidaController extends Controller
{
    public function index()
    {
        $horas = HoraAcogida::where('disponible', true)->orderBy('hora')->get();
        $hijos = Hijos::HijosPadres(auth()->user()->id);

        return view('acogida.detall', compact('horas', 'hijos'));
    }


    public function apuntar(Request $request)
    {
        $request->validate([
            'hora' => 'required|exists:horas_acogida,id,disponible,1',
            'hijo' => 'required|exists:hijos_Padres,hijos_id,user_id,' . auth()->user()->id
        ]);
        $hora = HoraAcogida::find($request->hora);
        
        if ($hora->hijos()->where('hijo_id', $request->hijo)->exists()) {
            return back()->withErrors(['message' => 'Este hijo ya está apuntado a esa hora.']);
        }

        dd("hola");

        
        $hora->hijos()->attach($request->hijo, ['user_id' => auth()->user()->id]);
    
        return redirect()->route('acogida.index')->with('success', 'Hijo apuntado correctamente.');
    }

}

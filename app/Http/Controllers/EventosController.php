<?php

namespace App\Http\Controllers;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Http\Request;
use App\Models\Eventos;

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
        $dades['eventos'] = Eventos::Proximos();

    
        return view('eventos/detall',$dades);
    }


    public function signup($event)
    {
        auth()->user()->eventos()->attach($event);
        return redirect()->back();
    }

}

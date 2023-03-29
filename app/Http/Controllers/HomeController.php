<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

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

        return view('home', $dades);
    }

    public function hacermonitor(Request $request){
        $user=auth()->user();
        $email = $request->email;
        $dades["monitor"]=$user["monitor"];
        $dades["admin"]=$user["admin"];

        $dades["success"]=false;
        $dades["nomuser"]=$email;

        $usuario= User::buscaruser($email);

        if(!Count($usuario)==0){
            if($usuario[0]["monitor"]==0){
                
                $dades["success"] = User::hacermonitor($usuario[0]['email']);
                $dades["monitoruser"] = true;
                $dades["nomuser"] = $usuario["name"];
            }
        }
        return view('home',$dades);
    }
}

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            @if (session('status'))
            <div class="card">
                <div class="card-header">{{ __('Avisos') }}</div>
                <div class="card-body">
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                </div>
            </div>
            @endif
            <br>
            <div class="card">
                <div class="card-header">Dades d'usuari:</div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Nom</th>
                                <th scope="col">Correu</th>
                            </tr>
                            <tr>
                                <td>{{$usuario->name}}</td>
                                <td>{{$usuario->email}}</td>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
            <br>
            <div class="card">
                <div class="card-header">Infants assignats:</div>
                <div class="card-body">

                    @if(count($hijosPropios)>0)
                        
                            <table class="table">
                                <thead>
                                    <tr>
                                    <th scope="col">Nom</th>
                                    <th class="d-none d-md-block" scope="col">Cognoms</th>
                                    <th scope="col">Correu</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($hijosPropios as $hijo)
                                    <tr>
                                    <td>{{$hijo->nombre}}</td>
                                    <td class="d-none d-md-block">{{$hijo->apellidos}}</td>
                                    <td>{{$hijo->correo}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                </table>
                        
                    @endif
                    @if(count($hijosPropios)==0)
                        <p>Vosté no té ningún infant enregistrat!</p>
                    @endif
                </div>
            </div>
            <br>
            <div class="card">
                <div class="card-header">Assignar infant:</div>
                    <div class="card-body">
                        <form action="{{route('assignarHijo')}}" method="POST">
                            @csrf
                                <br>
                                <label for="email" style="margin-left:30px">Email:      </label><input type="text" name="email" id="email" style="margin-left: 10px" required>
                                
                                <button type="submit" class="btn btn-primary" style="margin-right:30px; float: right">Assignar</button>
                        </form>
                    </div>
                </div>
                @if(isset($success))
                @if($success)
                <div class="alert alert-success text-center">
                    {{$fillAssignat}} assignat!
                </div>
                @endif
                @if(!$success)
                    @if(isset($fillAssignat))
                    <div class="alert alert-danger text-center">
                        Ja t'has assignat a {{$fillAssignat}}!
                    </div>
                    @endif
                    @if(!isset($fillAssignat))
                    <div class="alert alert-danger text-center">
                        No s'ha trobat l'email que ha introduit!
                    </div>
                    @endif

                    
                @endif

            @endif
            <br>
            <!-- Desassignar no funciona per foreign key-->
            <div class="card">
                <div class="card-header">Desassignar infant:</div>
                    <div class="card-body">
                        <form action="{{route('desassignarHijo')}}" method="POST">
                            @csrf
                                <br>
                                <label for="email" style="margin-left:30px">Email:      </label><input type="text" name="email" id="email" style="margin-left: 10px" required>
                                
                                <button type="submit" class="btn btn-primary" style="margin-right:30px; float: right">Desassignar</button>
                        </form>
                    </div>
                </div>
                @if(isset($aconseguit))
                @if($aconseguit)
                <div class="alert alert-success text-center">
                    {{$filldesAssignat}} desassignat!
                </div>
                @endif
                @if(!$aconseguit)
                @if(isset($fillAlNiu))
                <div class="alert alert-danger text-center">
                    El vostre Infant s'ha donat d'alta al niu! No es pot desassignar!
                </div>
                @endif
                    
                @endif

            @endif
            </div>
        </div>
    </div>
    @if($admin)
    @include('adminfunc/gestionadmin')
    @endif

    @if($monitor || $admin)
    @include('monitorfunc/gestionmonitor')
    @endif
</div>

@endsection

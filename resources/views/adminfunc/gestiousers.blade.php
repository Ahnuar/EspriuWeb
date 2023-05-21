@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header">Gestió de privilegis</div>
                <div class="card-body"> 
                    <h4>Monitors:</h4>
                <form action="{{route('hacermonitor')}}" method="POST">
                    @csrf
                
                    <div class="card">
                        <div class="card-header">Fer monitor per correu:</div>
                        <div class="card-body">
                            <label for="email" style="margin-left:30px">Email:      </label><input required type="text" name="email" id="email" style="margin-left: 10px">
                            
                            <button type="submit" class="btn btn-primary" style="margin-right:30px; float: right">Fer Monitor</button>
                        </div>
                    </div>
                </form>
                @if(isset($success))
                @if($success)
                <div class="alert alert-success text-center">
                    {{$nomuser}} ara es monitor!
                </div>
                @endif
                @if(!$success)
                <div class="alert alert-danger text-center">
                    El usuari amb correu {{$nomuser}} no existeix o ja es monitor
                </div>
                @endif

                @endif
                <form action="{{route('quitarMonitor')}}" method="POST">
                    @csrf
                    <br>
                    <div class="card">
                        <div class="card-header">Treure de monitors per correu:</div>
                        <div class="card-body">
                            <label for="email" style="margin-left:30px">Email:      </label><input required type="text" name="email" id="email" style="margin-left: 10px">
                            
                            <button type="submit" class="btn btn-primary" style="margin-right:30px; float: right">Treure Privilegis</button>
                        </div>
                    </div>
                </form>
                
                    @if(isset($desprivilegiat))
                    @if($desprivilegiat)
                    <div class="alert alert-success text-center">
                        {{$nomuser}} ja no es monitor!
                    </div>
                    @endif
                    @if(!$desprivilegiat)
                    <div class="alert alert-danger text-center">
                        El usuari amb correu {{$nomuser}} no existeix o ja no es monitor
                    </div>
                    @endif

                @endif
                <br>
                <h4 >Administradors:</h4>
                <form action="{{route('haceradmin')}}" method="POST">
                    @csrf
               
                    <div class="card">
                        <div class="card-header">Fer Administrador per correu:</div>
                        <div class="card-body">
                            <label for="email" style="margin-left:30px">Email:      </label><input required type="text" name="email" id="email" style="margin-left: 10px">
                            
                            <button type="submit" class="btn btn-primary" style="margin-right:30px; float: right">Fer Administrador</button>
                        </div>
                    </div>
                </form>
                @if(isset($successA))
                @if($successA)
                <div class="alert alert-success text-center">
                    {{$nomuser}} ara es administrador!
                </div>
                @endif
                @if(!$successA)
                <div class="alert alert-danger text-center">
                    El usuari amb correu {{$nomuser}} no existeix o ja es administrador
                </div>
                @endif

                @endif
                <form action="{{route('quitaradmin')}}" method="POST">
                    @csrf
                    <br>
                    <div class="card">
                        <div class="card-header">Treure de administradors per correu:</div>
                        <div class="card-body">
                            <label for="email" style="margin-left:30px">Email:      </label><input required type="text" name="email" id="email" style="margin-left: 10px">
                            
                            <button type="submit" class="btn btn-primary" style="margin-right:30px; float: right">Treure Privilegis</button>
                        </div>
                    </div>
                </form>
                
                    @if(isset($desprivilegiatA))
                    @if($desprivilegiatA)
                    <div class="alert alert-success text-center">
                        {{$nomuser}} ja no es administrador!
                    </div>
                    @endif
                    @if(!$desprivilegiatA)
                    <div class="alert alert-danger text-center">
                        El usuari amb correu {{$nomuser}} no existeix o ja no es administrador
                    </div>
                    @endif

                @endif
                </div>
                </div>
            </div>
    </div>
            <br>
            @if(isset($privilegiats) && $privilegiats)
            <div class="card">
                <div class="card-header">Monitors actuals:</div>
                <div class="card-body"> 
                    
                        
                    <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">Nom</th>
                            <th scope="col">Correu</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($privilegiats as $user)
                            @if($user->monitor==true)
                            <tr>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            </tr>
                            @endif
                            @endforeach
                        </tbody>
                        </table>
                
            
                </div>
            </div>
            <br>
                <div class="card">
                    <div class="card-header">Admins actuals:</div>
                    <div class="card-body"> 
                        
                            
                        <table class="table">
                            <thead>
                                <tr>
                                <th scope="col">Nom</th>
                                <th scope="col">Correu</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($privilegiats as $user)
                                @if($user->admin==true)
                                <tr>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                </tr>
                                @endif
                                @endforeach
                            </tbody>
                            </table>
                    </div>
            </div>
            @endif
        </div>
    </div>
</div>
</div>
@endsection
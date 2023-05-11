@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header">Gestió de monitors</div>
                <div class="card-body"> 
                <form action="{{route('hacermonitor')}}" method="POST">
                    @csrf
                    <br>
                    <div class="card">
                        <div class="card-header">Fer monitor per correu:</div>
                        <div class="card-body">
                            <label for="email" style="margin-left:30px">Email:      </label><input type="text" name="email" id="email" style="margin-left: 10px">
                            
                            <button type="submit" class="btn btn-primary" style="margin-right:30px; float: right">Fer Monitor</button>
                        </div>
                    </div>
                </form>
                    <br>
                    @if(isset($success))
                        @if($success)
                        <div class="alert alert-success text-center">
                            {{$nomuser}} ara es monitor!
                        </div>
                        @endif
                        @if(!$success)
                        <div class="alert alert-danger text-center">
                            El usuari amb correu {{$nomuser}} no existeix o ja es monitor :c
                        </div>
                        @endif

                    @endif
                </div>
            </div>
            <br>
            @if(isset($monitores) && $monitores)
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
                            @foreach($monitores as $monitor)
                            <tr>
                            <td>{{$monitor->name}}</td>
                            <td>{{$monitor->email}}</td>
                            </tr>
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
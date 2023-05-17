@extends('layouts.app')
@section('content')
<br>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            @include('adminfunc/insertarHijo')
            <br>
            <div class="card">
                <div class="card-header">Infants insertats:</div>
                <div class="card-body"> 
                    @if(isset($Infants) && $Infants)
                    <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">Nom</th>
                            <th class="d-none d-md-block" scope="col">Cognoms</th>
                            <th scope="col">Correu</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($Infants as $Infant)
                            <tr>
                            <td>{{$Infant->nombre}}</td>
                            <td class="d-none d-md-block">{{$Infant->apellidos}}</td>
                            <td>{{$Infant->correo}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        </table>
                    @endif
                    @if(!isset($Infants) && !$Infants)
                    <p>No hi han Infants a la base de dades!</p>
                    @endif
                </div>
            </div>
           

        </div>
    </div>
</div>
@endsection

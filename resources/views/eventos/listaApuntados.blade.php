@extends('layouts.app')


@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>Llista apuntats: </h1>
                <table class="table">
                    <thead>
                        <th scope="col">Persona asignada</th>
                        <th scope="col">Nom Infant</th>
                        <th scope="col">Cognoms Infant</th>
                        <th scope="col">Correu</th>
                    </thead>
                    <tbody>
                        @foreach($listaApuntados as $infant)
                        <td>{{$infant->name}}</td>
                        <td>{{$infant->nombre}}</td>
                        <td>{{$infant->apellidos}}</td>
                        <td>{{$infant->correo}}</td>
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>
    </div>
@endsection
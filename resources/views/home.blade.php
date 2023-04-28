@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header">{{ __('Avisos') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    {{ __('Ja estàs enregistrat!') }}
                </div>
            </div>
            <br>
            <div class="card">
                <div class="card-header">Fills:</div>
                <div class="card-body">

                    @if(count($hijosPropios)>0)
                        @foreach($hijosPropios as $hijo)
                            <table class="table">
                                <thead>
                                    <tr>
                                    <th scope="col">Nom</th>
                                    <th scope="col">Cognoms</th>
                                    <th scope="col">Correu</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                    <td>{{$hijo->nombre}}</td>
                                    <td>{{$hijo->apellidos}}</td>
                                    <td>{{$hijo->correo}}</td>
                                    </tr>
                                </tbody>
                                </table>
                        @endforeach
                    @endif
                    @if(count($hijosPropios)==0)
                        <p>Vosté no té ningún fill enregistrat!</p>
                    @endif
                </div>
            </div>
            <br>
            <div class="card">
                <div class="card-header">Assignar nen com a fill:</div>
                    <div class="card-body">
                        <form action="{{route('assignarHijo')}}" method="POST" id="selectNen">
                            @csrf
                            <select name="nenSelected" id="nenSelected" form="selectNen" class="form-control pepe">
                                @foreach($hijos as $nen)
                                    <option value="{{$nen["id"]}}">{{$nen->nombre}} {{$nen->apellidos}}</option>
                                @endforeach
                            </select>
                            <br>
                            <button type="submit" class="btn btn-primary">Assignar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if($admin)
    @include('adminfunc/gestionadmin')
    @endif


    @if($monitor)
    @include('monitorfunc/gestionmonitor')
    @endif
</div>

@endsection

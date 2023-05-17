@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header">Gestió del niu:</div>
                <div class="card-body">
                <!-- tabla horas acogida 
                altas bajas y modificaciones hora inicio hora fin dia semana precio 
              
            -->
                <br>
                <div class="card">
                    <div class="card-header">Mètode de búsqueda:</div>
                    <div class="card-body">
                        <form action="{{route('buscarHorasXDia')}}" method="POST" id="selectDies">
                            @csrf
                            <label for="diaSelected">Dia setmana: </label>
                                <select name="diaSelected" id="diaSelected" class="form-control pepe">
                                    <option value="1">Dilluns</option>
                                    <option value="2">Dimarts</option>
                                    <option value="3">Dimecres</option>
                                    <option value="4">Dijous</option>
                                    <option value="5">Divendres</option>
                                </select>
                            <br>
                            <button type="submit" class="btn btn-primary">Buscar</button>
                        </form>
                        
                        @if(isset($trobat))
                        <form action="{{route('buscarHora')}}" method="POST" id="selectHoras">
                            @csrf
                            @if(isset($diaPreselected))
                                @if($diaPreselected!=0)
                                <input type="text" name="diaselected" id="diaselected" style="visibility: hidden" value="{{$diaPreselected}}">
                                @endif
                            @endif
                            <br>
                            <label for="horaSelected">Hora: </label>
                            <select name="horaSelected" id="horaSelected" form="selectHoras" class="form-control pepe">
                                @foreach($horesXDia as $hora)
                                    <option value="{{$hora["id"]}}">{{$hora->hora_inicio}} - {{$hora->hora_fin}}</option>
                                @endforeach
                        </select>
                        <br>
                        <button type="submit" class="btn btn-primary">Buscar</button>
                    </form>
                    </div>
                </div>
                @endif
                @if(isset($modificat))
                    @if($modificat)
                    <div class="alert alert-success text-center">
                        Hora {{$horaModificada}} modificada!
                    </div>
                    @endif
                @endif
                @if(isset($eliminat))
                    @if($eliminat)
                    <div class="alert alert-success text-center">
                        Hora {{$horaEliminada}} eliminada!
                    </div>
                    @endif
                @endif
                @if(isset($insertat))
                @if($insertat)
                <div class="alert alert-success text-center">
                    Hora {{$horaInsertada}} insertada!
                </div>
                @endif
            @endif


                @if(isset($horaTrobada))
                <br>
                <div class="card">
                    <div class="card-header">{{$horaSelected->hora_inicio}} - {{$horaSelected->hora_fin}}</div>
                    <div class="card-body">
                        <form action="{{route('modificarHora')}}" method="POST" id="modificarHoras">
                            @csrf
                            <div style="visibility: hidden">
                                <label for="id"  >Id: </label><input class="form-control pepe" type="text" value="{{$horaSelected->id}}" name="id" id="id" readonly>
                            </div>
                            <label for="horaInici">Hora inici:</label><input required class="form-control pepe" value="{{$horaSelected->hora_inicio}}" type="time" name="horaInici" id="horaInici"   required><br><br>
                            <label for="horaFinal">Hora Final:</label><input required class="form-control pepe" value="{{$horaSelected->hora_fin}}" type="time" name="horaFinal" id="horaFinal"   required><br><br>
                            <label for="preu">Preu:</label><input required class="form-control pepe" type="number" id="preu" name="preu" value="{{$horaSelected->Precio}}"   required><br><br>
                            <button type="submit" class="btn btn-primary adminfunc" style="float: left">Modificar</button>
                        </form>
                        <form action="{{route('eliminarHora')}}" method="POST">
                            @csrf

                            <button type="submit" class="btn btn-primary adminfunc eliminar">Eliminar</button>
                            <div style="visibility: hidden">
                                <label for="id"  >Id: </label><input type="text" value="{{$horaSelected->id}}" name="id" id="id" readonly><br><br>
                            </div>
                        </form>
                    </div>
                </div>
                @endif
                <br>
                </div>
            </div>
        </div>
    </div>
    <br>
    <!-- FUNCTION INSERTARHORA IN PROGRESS-->
    <div class="card">
        <div class="card-header">Insertar hora:</div>
        <div class="card-body">
            <form action="{{route('insertarHora')}}" method="POST" id="insertarHora">
                @csrf
                <label for="diaSelected"  >Dia setmana: </label>
                <select name="diaSelected" id="diaSelected" class="form-control pepe"  >
                    <option value="1">Dilluns</option>
                    <option value="2">Dimarts</option>
                    <option value="3">Dimecres</option>
                    <option value="4">Dijous</option>
                    <option value="5">Divendres</option>
                </select>
                <br>
                <label for="horaInici"  >Hora inici:</label><input required class="form-control pepe" type="time" name="horaInici" id="horaInici"   required><br><br>
                <label for="horaFinal"  >Hora Final:</label><input required class="form-control pepe" type="time" name="horaFinal" id="horaFinal"   required><br><br>
                <label for="preu"  >Preu:</label><input required class="form-control pepe" type="number" id="preu" name="preu"   required><br><br>
                <button type="submit" class="btn btn-primary adminfunc" style="float: left">Insertar</button>
            </form>
        </div>
    </div>
</div>
@endsection
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header">Gestió del niu:</div>
                <!-- tabla horas acogida 
                altas bajas y modificaciones hora inicio hora fin dia semana precio -->

                <div class="card">
                    <div class="card-header">Mètode de búsqueda:</div>
                    <div class="card-body">
                        <form action="{{route('buscarHora')}}" method="POST" id="selectHoras">
                            @csrf
                            <label for="horaSelected">Buscar per nom: </label>
                            <select name="horaSelected" id="horaSelected" form="selectHoras" class="form-control pepe">
                                @foreach($horas as $hora)
                                    <option value="{{$hora["id"]}}">{{$hora->hora_inicio}} - {{$hora->hora_fin}}</option>
                                @endforeach
                            </select>
                            <br>
                            <button type="submit" class="btn btn-primary">Buscar</button>
                        </form>     
                    </div>
                </div>

                @if(isset($trobat))
                    @if($trobat)
                    <div class="card">
                        <div class="card-header">{{$horaSelected->hora_inicio}} - {{$horaSelected->hora_fin}}</div>
                        <div class="card-body">
                            <form action="" method="POST">
                                @csrf
                                <div style="visibility: hidden">
                                    <label for="id" style="margin-left:30px">Id: </label><input class="form-control pepe" type="text" value="{{$horaSelected->id}}" name="id" id="id" readonly>
                                </div>
                                <label for="nombre" style="margin-left:30px">Hora inici:</label><input required class="form-control pepe" value="{{$horaSelected->hora_inicio}}" type="text" name="hora_inicio" id="hora_inicio" style="margin-left: 10px"><br><br>
                                <label for="desc" style="margin-left:30px">Hora Final:</label><input required class="form-control pepe" value="{{$horaSelected->hora_fin}}" type="text" name="hora_fin" id="hora_fin" style="margin-left: 10px"><br><br>
                                <label for="data" style="margin-left:30px">Preu:</label><input required class="form-control pepe" type="number" id="Precio" name="Precio" value="{{$horaSelected->Precio}}"><br><br>
                                <button type="submit" class="btn btn-primary" style="margin-right:30px; float: right">Modificar</button>
            
                            </form>
                            <!--eliminar-->
                            <form action="" method="POST">
                                @csrf
                                <div style="visibility: hidden">
                                    <label for="id" style="margin-left:30px">Id: </label><input type="text" value="{{$horaSelected->id}}" name="id" id="id" readonly><br><br>
                                </div>
                                <button type="submit" class="btn btn-primary">Eliminar</button>
                            </form>
                        </div>
                    </div>
                    @endif
                @endif
                <br>
            </div>
        </div>
    </div>
</div>
@endsection
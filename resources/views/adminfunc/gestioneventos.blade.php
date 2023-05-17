@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
<div class="card">
    <div class="card-header">Modificar i Eliminar Events:</div>
    <div class="card-body">
        @if(count($eventos)==0)  
        No hi han events actualment!
        </div>
    </div>
        @endif
        @if(count($eventos)>0)
        <div class="card">
            <div class="card-header">Mètode de búsqueda:</div>
            <div class="card-body">
                <form action="{{route('buscarEvento')}}" method="POST" id="selectEventos">
                    @csrf
                    <label for="nombreEvento">Buscar per nom: </label>
                    <select name="nombreEvento" id="nombreEvento" form="selectEventos" class="form-control pepe">
                        @foreach($eventos as $evento)
                            <option value="{{$evento->id}}">{{$evento->nombre}}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="btn btn-primary">Buscar</button>
                </form>
                <br>
                <form action="{{route('mostrarTodos')}}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-primary">Mostrar Tots</button>
                </form>

            </div>
        </div>
        <br>
            @if(isset($modificat))
                @if($modificat)
                <div class="alert alert-success text-center">
                    Event {{$eventAlterat}} Modificat!
                </div>
                @endif
                @if(!$modificat)
                <div class="alert alert-danger text-center">
                    No s'ha pogut modificar l'event {{$eventAlterat}}
                </div>
                @endif
            @endif
            
            @if(isset($eliminado))
                @if($eliminado)
                <div class="alert alert-success text-center">
                    Event {{$eventoEliminado}} Eliminat!
                </div>
                @endif
                @if(!$eliminado)
                <div class="alert alert-danger text-center">
                    No s'ha pogut modificar l'event {{$eventoEliminado}}
                </div>
                @endif
            @endif
        <br>
        
        @if(isset($trobat))
            @if($trobat)
            <div class="card">
                <div class="card-header">{{$eventoSelected->nombre}}</div>
                <div class="card-body">
                    <form action="{{route('modificarevento')}}" method="POST">
                        @csrf
                        <div style="visibility: hidden">
                            <label for="id"  >Id: </label><input class="form-control pepe" type="text" value="{{$eventoSelected->id}}" name="id" id="id" readonly>
                        </div>
                        <label for="nombre"  >Nom:</label><input required class="form-control pepe" value="{{$eventoSelected->nombre}}" type="text" name="nombre" id="nombre"  ><br><br>
                        <label for="desc"  >Descripció:</label><textarea required class="form-control pepe" name="desc" id="desc"  >{{$eventoSelected->descripcion}}</textarea><br><br>
                        <label for="data"  >Data-Hora:</label><input required class="form-control pepe" type="datetime-local" id="data" name="data" value="{{$eventoSelected->fecha_hora_evento}}"><br><br>
                        <button type="submit" class="btn btn-primary" style="float: left">Modificar</button>
    
                    </form>
                    <form action="{{route('eliminarEvento')}}" method="POST">
                        @csrf

                        <button type="submit" class="btn btn-primary eliminar">Eliminar</button>
                        <div style="visibility: hidden">
                            <label for="id">Id: </label><input type="text" value="{{$eventoSelected->id}}" name="id" id="id" readonly><br><br>
                        </div>
                    </form>
                </div>
            </div>
            @endif
        @endif
            
        @if(isset($tots))
            @foreach($eventos as $evento)
            <div class="card">
                <div class="card-header">{{$evento->nombre}}</div>
                <div class="card-body">
                    <form action="{{route('modificarevento')}}" method="POST">
                        @csrf
                        <div style="visibility: hidden">
                            <label for="id"  >Id: </label><input type="text" value="{{$evento->id}}" name="id" id="id" readonly><br><br>
                        </div>
                        <label for="nombre"  >Nom:</label><input required class="form-control pepe" value="{{$evento->nombre}}" type="text" name="nombre" id="nombre"  ><br><br>
                        <label for="desc"  >Descripció:</label><textarea required class="form-control pepe" name="desc" id="desc"  >{{$evento->descripcion}}</textarea><br><br>
                        <label for="url"  >Url Google Maps:</label><textarea required class="form-control pepe" name="url" id="url"  >{{$evento->url_google_maps}}</textarea><br><br>
                        <label for="curs"  >Curs:</label><input required class="form-control pepe" value="{{$evento->curso}}" type="text" name="curs" id="curs"  ><br><br>
                        <label for="data"  >Data-Hora:</label><input required class="form-control pepe" type="datetime-local" id="data" name="data" value="{{$evento->fecha_hora_evento}}"><br><br>
                        <button type="submit" class="btn btn-primary" style="float: left">Modificar</button>
    
                    </form>
                    <form action="{{route('eliminarEvento')}}" method="POST">
                        @csrf

                        <button type="submit" class="btn btn-primary eliminar">Eliminar</button>
                        <div style="visibility: hidden">
                            <label for="id">Id: </label><input type="text" value="{{$evento->id}}" name="id" id="id" readonly><br><br>
                        </div>
                    </form>
                </div>
            </div>
            <br>
            @endforeach
        
        @endif
        @endif
    </div>

</div>
<br>

<div class="card">
    <div class="card-header">Insertar Event:</div>
    <div class="card-body">
        <form action="{{route('insertarEvento')}}" method="POST">
            @csrf
            <div style="visibility: hidden">
                <label for="id" >Id: </label><input type="text"  name="id" id="id" readonly><br><br>
            </div>
            <label for="nombre">Nom:</label><input required class="form-control pepe" type="text" name="nombre" id="nombre"><br><br>
            <label for="desc"  >Descripció:</label><textarea required class="form-control pepe" name="desc" id="desc" ></textarea><br><br>
            <label for="url"  >Url Google Maps:</label><textarea required class="form-control pepe" name="url" id="url"></textarea><br><br>
            <label for="curs"  >Curs:</label><input required class="form-control pepe" type="text" name="curs" id="curs"><br><br>
            <label for="data"  >Data-Hora:</label><input required class="form-control pepe" type="datetime-local" id="data" name="data"><br><br>
            <button type="submit" class="btn btn-primary" >Insertar</button>

        </form>
        @if(isset($creado))
        @if($creado)
        <div class="alert alert-success text-center">
            Event {{$eventInsertat}} insertat!
        </div>
        @endif
        @if(!$creado)
        <div class="alert alert-danger text-center">
            S'han d'omplir tots els camps!
        </div>
        @endif
    @endif
    </div>
</div>
</div>
</div>
@endsection

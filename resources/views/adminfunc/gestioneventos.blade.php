<div class="card">
    <!-- -->
    <div class="card-header">Modificar i Eliminar Events:</div>
    <div class="card-body">
        <div class="card">
            <div class="card-header">Mètode de búsqueda:</div>
            <div class="card-body">
                <form action="{{route('home.buscarEvento')}}" method="POST" id="selectEventos">
                    @csrf
                    <label for="nombreEvento">Buscar per nom: </label>
                    <select name="nombreEvento" id="nombreEvento" form="selectEventos" >
                        @foreach($eventos as $evento)
                            <option value="{{$evento->id}}">{{$evento->nombre}}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="btn btn-primary" style="margin-right:30px; float: right">Buscar</button>
                </form>
                <br>
                <form action="{{route('home.mostrarTodos')}}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-primary">Mostrar Tots</button>
                </form>
                
   
            </div>
        </div>
        <br>
        @if(isset($trobat))
            @if($trobat)
            <div class="card">
                <div class="card-header">{{$eventoSelected->nombre}}</div>
                <div class="card-body">
                    <form action="{{route('home.modificarevento')}}" method="POST">
                        @csrf
                        <div style="visibility: hidden">
                            <label for="id" style="margin-left:30px">Id: </label><input type="text" value="{{$eventoSelected->id}}" name="id" id="id" readonly><br><br>
                        </div>
                        <label for="nombre" style="margin-left:30px">Nom:</label><input value="{{$eventoSelected->nombre}}" type="text" name="nombre" id="nombre" style="margin-left: 10px"><br><br>
                        <label for="desc" style="margin-left:30px">Descripció:</label><textarea name="desc" id="desc" style="margin-left: 10px">{{$eventoSelected->descripcion}}</textarea><br><br>
                        <label for="data" style="margin-left:30px">Data-Hora:</label><input type="datetime-local" id="data" name="data" value="{{$eventoSelected->fecha_hora_evento}}"><br><br>
                        <button type="submit" class="btn btn-primary" style="margin-right:30px; float: right">Modificar</button>
       
                    </form>
                    <form action="{{route('home.eliminarEvento')}}" method="POST">
                        @csrf
                        <div style="visibility: hidden">
                            <label for="id" style="margin-left:30px">Id: </label><input type="text" value="{{$eventoSelected->id}}" name="id" id="id" readonly><br><br>
                        </div>
                        <button type="submit" class="btn btn-primary">Eliminar</button>
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
                    <form action="{{route('home.modificarevento')}}" method="POST">
                        @csrf
                        <div style="visibility: hidden">
                            <label for="id" style="margin-left:30px">Id: </label><input type="text" value="{{$evento->id}}" name="id" id="id" readonly><br><br>
                        </div>
                        <label for="nombre" style="margin-left:30px">Nom:</label><input value="{{$evento->nombre}}" type="text" name="nombre" id="nombre" style="margin-left: 10px"><br><br>
                        <label for="desc" style="margin-left:30px">Descripció:</label><textarea name="desc" id="desc" style="margin-left: 10px">{{$evento->descripcion}}</textarea><br><br>
                        <label for="url" style="margin-left:30px">Url Google Maps:</label><textarea name="url" id="url" style="margin-left: 10px">{{$evento->url_google_maps}}</textarea><br><br>
                        <label for="curs" style="margin-left:30px">Curs:</label><input value="{{$evento->curso}}" type="text" name="curs" id="curs" style="margin-left: 10px"><br><br>
                        <label for="data" style="margin-left:30px">Data-Hora:</label><input type="datetime-local" id="data" name="data" value="{{$evento->fecha_hora_evento}}"><br><br>
                        <button type="submit" class="btn btn-primary" style="margin-right:30px; float: right">Modificar</button>
    
                    </form>
                </div>
            </div>
            <br>
            @endforeach
        </div>
        @endif
    </div>
    @if(isset($success))
    @if($success)
    <div class="alert alert-success text-center">
        Event {{$eventAlterat}} Modificat!
    </div>
    @endif
    @if(!$success)
    <div class="alert alert-danger text-center">
        No s'ha pogut modificar l'event {{$eventAlterat}}
    </div>
    @endif

@endif

</div>
<br>

<div class="card">
    <div class="card-header">Insertar Event:</div>
    <div class="card-body">
        <form action="{{route('home.insertarEvento')}}" method="POST">
            @csrf
            <div style="visibility: hidden">
                <label for="id" style="margin-left:30px">Id: </label><input type="text"  name="id" id="id" readonly><br><br>
            </div>
            <label for="nombre" style="margin-left:30px">Nom:</label><input  type="text" name="nombre" id="nombre" style="margin-left: 10px"><br><br>
            <label for="desc" style="margin-left:30px">Descripció:</label><textarea name="desc" id="desc" style="margin-left: 10px"></textarea><br><br>
            <label for="url" style="margin-left:30px">Url Google Maps:</label><textarea name="url" id="url" style="margin-left: 10px"></textarea><br><br>
            <label for="curs" style="margin-left:30px">Curs:</label><input  type="text" name="curs" id="curs" style="margin-left: 10px"><br><br>
            <label for="data" style="margin-left:30px">Data-Hora:</label><input type="datetime-local" id="data" name="data"><br><br>
            <button type="submit" class="btn btn-primary" style="margin-right:30px; float: right">Insertar</button>

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
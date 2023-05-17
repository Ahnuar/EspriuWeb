
<div class="card">
    <div class="card-header">Insertar Infant:</div>
    <div class="card-body">  
        <form action="{{route('insertarFill')}}" method="POST">
            @csrf
            <div style="visibility: hidden">
                <label for="id"  >Id: </label><input type="text"  name="id" id="id" readonly><br><br>
            </div>
            <label for="nombre"  >Nom:</label><br><input required class="form-control pepe" type="text" name="nombre" id="nombre"  ><br><br>
            <label for="apellidos"  >Cognoms:</label><br><input required class="form-control pepe" type="text" name="apellidos" id="apellidos"  ><br><br>
            <label for="correo"  >Correu:</label><br><input required class="form-control pepe" type="text" name="correo" id="correo"  ><br><br>
            <button type="submit" class="btn btn-primary">Insertar</button>
        </form>
    </div>
</div>
@if(isset($creado))
    @if($creado)
    <div class="alert alert-success text-center">
        Infant {{$fillInsertat}} insertat!
    </div>
    @endif
    @if(!$creado)
        @if(isset($fillInsertat))
        <div class="alert alert-danger text-center">
            Infant amb correu ja inserit!
        </div>
        @endif
        @if(!isset($fillInsertat))
        <div class="alert alert-danger text-center">
            S'han d'omplir tots els camps!
        </div>
        @endif
    @endif
@endif


<div class="card">
    <div class="card-header">Insertar Fill:</div>
    <div class="card-body">  
        <form action="{{route('insertarFill')}}" method="POST">
            @csrf
            <div style="visibility: hidden">
                <label for="id" style="margin-left:30px">Id: </label><input type="text"  name="id" id="id" readonly><br><br>
            </div>
            <label for="nombre" style="margin-left:30px">Nom:</label><br><input class="form-control w-50" type="text" name="nombre" id="nombre" style="margin-left: 10px"><br><br>
            <label for="apellidos" style="margin-left:30px">Cognoms:</label><br><input class="form-control w-50" type="text" name="apellidos" id="apellidos" style="margin-left: 10px"><br><br>
            <label for="correo" style="margin-left:30px">Correu:</label><br><input class="form-control w-50" type="text" name="correo" id="correo" style="margin-left: 10px"><br><br>
            <button type="submit" class="btn btn-primary" style="margin-right:30px; float: right">Insertar</button>

        </form>

    </div>
</div>
@if(isset($creado))
@if($creado)
<div class="alert alert-success text-center">
    Fill {{$fillInsertat}} insertat!
</div>
@endif
@if(!$creado)
<div class="alert alert-danger text-center">
    S'han d'omplir tots els camps!
</div>
@endif
@endif

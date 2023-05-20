<div class="card mb-5">
    <div class="card-header text-center"><h5>{{$evento->nombre}}</h5></div>
    <div class="card-body">
        <p class="card-text">{{$evento->descripcion}}</p>
        <p class="card-text">{{$evento->fecha_hora_evento}}</p>
        <p class="card-text">Gent apuntada: {{$evento->conteo}}</p>
        @if($evento->url_google_maps!=null && $evento->url_google_maps!='')
           <div class="w-100"> {!! $evento->url_google_maps !!}</div>
        @endif
        <br>
        @if(isset($hijos) && count($hijos)>0)
        <div class="row">
            <form method="POST" action="{{ route('evento.signup') }}" name="inscribir{{$evento->id}}" id="inscribir{{$evento->id}}">
                @csrf
                <input type="text" hidden value="{{$evento->id}}" id="idEvento" name="idEvento">
                
                <select name="selectHijo" id="selectHijo" form="inscribir{{$evento->id}}" class="form-control">
                    @foreach($hijos as $hijo)
                        <option value="{{$hijo->id}}">{{$hijo->nombre}} {{$hijo->apellidos}}</option>
                    @endforeach
                </select>
                <br>
                <button type="submit" class="btn btn-primary  w-100">INSCRIURE</a>
            </form>
        </div>
        @endif
    </div>
    @if(isset($success))
        @if($evento->id ==$eventoInscrito)
            @if($success)
                <div class="alert alert-success text-center">
                    Infant {{$fillInscrit}} inscrit!
                </div>
            @endif
            @if(!$success)
                <div class="alert alert-danger text-center">
                    Ja has inscrit a {{$fillInscrit}} en aquest event!
                </div>
            @endif
        @endif
    @endif
</div>



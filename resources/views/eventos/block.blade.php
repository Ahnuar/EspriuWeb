<div class="card mb-5">
    <div class="card-header text-center"><h5>{{$evento->nombre}}</h5></div>
    <div class="card-body">
        <p class="card-text">{{$evento->descripcion}}</p>
        <p class="card-text">{{$evento->fecha_hora_evento}}</p>
        <iframe class="mb-3" src="{{$evento->url_google_maps}}" frameborder="0" style="border:0; width:100%; height: 300px; " allowfullscreen></iframe>
        <div class="d-flex justify-content-end">

            <form method="POST" action="{{ route('evento.signup', $evento) }}">
                @csrf
                <button type="submit" class="btn btn-primary text-end">INSCRIBIRME</a>
            </form>
            
        </div>
    </div>
</div>
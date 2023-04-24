<br>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header">Fills:</div>
                <div class="card-body">
                    @if(count($hijos)>0)
                        @foreach($hijos as $hijo)
                            <div class="card">
                                <div class="card-header">{{$hijo->nombre}}:</div>
                                    <div class="card-body">
                                        <br>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                    @if(count($hijos)==0)
                        <p>Vosté no té ningún fill enregistrat!</p>
                    @endif
                    <!--insertar hijo solo para administrador, asignar hijo para el usuario-->
                    @include('hijos/insertarHijo')
                </div>
            </div>
        </div>
    </div>
</div>

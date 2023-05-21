<br>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header">Funcions d'Administrador</div>
                <div class="card-body"> 
                    <div class="row">
                            <div class="col-12 col-md-3">
                                <form action="{{route('gestioneventos')}}">
                                    <button class="btn btn-primary text-center w-100">Gestió Events</button>
                                </form>
                            </div>
                            <div class="col-12 col-md-3">
                                <form action="{{route('altasbajasmonitores')}}">
                                    <button class="btn btn-primary text-center w-100" >Gestió Privilegis</button>
                                </form>
                            </div>
                            <div class="col-12 col-md-3">
                                <form action="{{route('gestioNiu')}}">
                                    <button class="btn btn-primary text-center w-100" >Gestió Niu</button>
                                </form>
                            </div>
                            <div class="col-12 col-md-3">
                                <form action="{{route('gestioFills')}}">
                                    <button class="btn btn-primary text-center w-100" >Gestió Infants</button>
                                </form>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

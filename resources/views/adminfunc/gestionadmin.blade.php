<br>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header">Funcions d'Administrador</div>
                <div class="card-body">  
                    <div class="btn-group mr-2" role="group" aria-label="First group">
                        <form action="{{route('gestioneventos')}}">
                            <button class="btn btn-primary adminfunc">Gestió Events</button>
                        </form>
    
                        <form action="{{route('altasbajasmonitores')}}">
                            <button class="btn btn-primary adminfunc" >Gestió Monitors</button>
                        </form>
    
                        <form action="{{route('gestioNiu')}}">
                            <button class="btn btn-primary adminfunc" >Gestió Niu</button>
                        </form>
                        
                        <form action="{{route('gestioFills')}}">
                            <button class="btn btn-primary adminfunc" >Gestió Fills</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<br>
<!--
    Hacer botones en fila
-->
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header">Funcions d'Administrador</div>
                <div class="card-body">  
                    <form action="{{route('gestioneventos')}}">
                        <button class="btn btn-primary adminfunc" style="float: left" >Gestió Events</button>
                    </form>

                    <form action="{{route('altasbajasmonitores')}}">
                        <button class="btn btn-primary adminfunc" >Gestió Monitors</button>
                    </form>  
                </div>
            </div>
        </div>
    </div>
</div>

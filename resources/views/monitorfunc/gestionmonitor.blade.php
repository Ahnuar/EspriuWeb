<br>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header">Funcions de Monitor:</div>
                <div class="card-body">
                    <div class="row">
                            <div class="col-12 col-md-6">
                                <form action="{{route('lista')}}">
                                    <button class="btn btn-primary text-center w-100" >Passar llista</button>
                                </form>
                            </div>
                            <div class="col-12 col-md-6">
                                <form action="{{route('exportar')}}">
                                    <button class="btn btn-primary text-center w-100" >Exportar Mensual</button>
                                    <select name="mes" id="mes" class="form-control text-center w-100" >
                                        <option value="1">Gener</option>
                                        <option value="2">Febrer</option>
                                        <option value="3">Març</option>
                                        <option value="4">Abril</option>
                                        <option value="5">Maig</option>
                                        <option value="6">Juny</option>
                                        <option value="7">Juliol</option>
                                        <option value="8">Agost</option>
                                        <option value="9">Septembre</option>
                                        <option value="10">Octubre</option>
                                        <option value="11">Novembre</option>
                                        <option value="12">Desembre</option> 
                                    </select>
                                </form>
                            
                        </div>                        
                    </div>
                </div>

            </div>
            @if(isset($exportat))
            @if($exportat)
            <div class="alert alert-success text-center">
                Facturació exportada al teu escriptori!
            </div>
            @endif
            @if(!$exportat)
            <div class="alert alert-danger text-center">
                No s'ha pogut exportar la facturació d'aquest més!
            </div>
            @endif
        @endif
        </div>
    </div>
</div>

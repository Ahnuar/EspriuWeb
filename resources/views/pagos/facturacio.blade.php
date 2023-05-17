@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="col-12">
            <h1>Facturació</h1>
        </div>
        <div class="col-12">
            <label for="mes">Mes: </label>
            <select name="mes" id="mes">
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
                <option value="12">Decembre</option>
            </select>
        </div>
    </div>



        <div class="container">
            <div class="row">
                
                <div class="col-12">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Nom Alumne</th>
                                <th scope="col" class="d-none d-md-inline-block">Cognoms</th>
                                <th scope="col">Dia</th>
                                <th scope="col" class="d-none d-md-inline-block">Hora Inici</th>
                                <th scope="col" class="d-none d-md-inline-block">Hora Final</th>
                                <th scope="col">Preu</th>
                            </tr>
                        </thead>

                    </table>
                </div>
            </div>
        </div>

    
        @section('script')
        <script src="{{ asset('js/facturacio.js') }}" ></script>

        <script>
            // Obtener la fecha actual
            var fechaActual = new Date();
            // Obtener el mes actual (0-11)
            var mesActual = fechaActual.getMonth();
            // Obtener el elemento select
            var selectMeses = document.getElementById("mes");
            // Establecer el mes actual como seleccionado
            selectMeses.options[mesActual].selected = true;

            
        </script>
    @endsection 
@endsection



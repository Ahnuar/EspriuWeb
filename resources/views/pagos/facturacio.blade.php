@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="col-12">
            <h1>Facturació</h1>
        </div>
        @if(session('success'))
            <div class="alert alert-success text-center">
                {{ session('success') }}
            </div>
        @endif
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
                                <th scope="col" class="dnone">Cognoms</th>
                                <th scope="col">Dia</th>
                                <th scope="col" class="dnone">Hora Inici</th>
                                <th scope="col" class="dnone">Hora Final</th>
                                <th scope="col">Preu</th>
                            </tr>
                        </thead>

                    </table>
                </div>
            </div>


            <div class="row">
                <div class="col-12">
                    <form method="POST" action="{{ route('facturacio.deletehora') }}">
                        @csrf
                        <div class="form-group">
                            @if(isset($horasNoperiodicas) && count($horasNoperiodicas)>0)
                           

                                <label for ="hora">Horas Apuntas No Periodicament</label>
                                <select name="hora" id="hora" class="form-control my-2">
                                    @foreach($horasNoperiodicas as $hora)
                                        <option value="{{ $hora }}"> Hora inici: {{$hora->hora_inicio }}, Hora Fi: {{ $hora->hora_fin }}, Data: {{$hora->fecha}}, Infant: {{$hora->nombre}}</option>
                                    @endforeach
                                </select>
                                <button type="submit" class="btn btn-primary mt-5 d-flex" style="float: right;">delete</button>
                            @endif
                        </div>
                    </form>
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



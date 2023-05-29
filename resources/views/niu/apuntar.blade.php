@extends('layouts.app')

@section('content')

    @if(@isset($id))
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>Apuntar a NIU</h1>
                @if ($errors->any())
                    <div class="alert alert-danger text-center">
                        @foreach ($errors->all() as $error)
                            {{ $error }}
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
        <div class="row" id="frmApuntar">
            <div class="col-12">
                <form method="POST" action="{{ route('niu.apuntar') }}">
                    @csrf
                    <div class="form-group">
                        <label for="hora">Hora</label>
                        <select name="hora" id="hora" class="form-control">
                            @foreach($eventHoras as $hora)
                                @php 
                                    $dia = explode(" ", $hora["start"])[0];
                                    $dia = date("d/m/Y", strtotime($dia));
                                    $start = explode(" ", $hora["start"])[1];
                                    $end = explode(" ", $hora["end"])[1];
                                @endphp
                                <option value="{{ $hora["start"] . " " . $end }}" @if( $id == $hora["id"]) selected @endif>{{ $start ." - " . $end . " " .$dia }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group my-3">
                        <label for="hijo">Infant</label>
                        <select name="hijo" id="hijo" class="form-control">
                            @foreach($hijos as $hijo)
                                <option value="{{ $hijo->id }}" @if(old('hijo') == $hijo->id) selected @endif>{{ $hijo->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary mt-5 d-flex" style="float: right;">Apuntar</button>
                </form>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <button type="submit" class="btn btn-primary my-3" id="btnFacturacion">Facturació periòdica</button>
                <button type="submit" class="btn btn-primary my-3" id="btnFacturacionManual" style="display: none;">Facturació manual</button>
            </div>


            <div class="col-12" id="frmP" style="display: none;">


                <form method="POST" action="{{ route('niu.apuntarPeriodico') }}">
                    @csrf
                    <div class="form-group">
                        @if(isset($horas) && $horas)
                            <label for="hijo">Infant</label>
                            <select name="hijo" id="hijo" class="form-control my-2">
                                @foreach($hijos as $hijo)
                                    <option value="{{ $hijo->id }}" @if(old('hijo') == $hijo->id) selected @endif>{{ $hijo->nombre }}</option>
                                @endforeach
                            </select>

                            <label for ="hora">Hora</label>
                            <select name="hora" id="hora" class="form-control my-2">
                                @foreach($horas as $hora)
                                    <option value="{{ $hora }}"> Hora inici: {{$hora->hora_inicio }}, Hora Fi: {{ $hora->hora_fin }}, Data final: {{$hora->fecha_fin}}</option>
                                @endforeach
                            </select>
                            <p class="my-2"> <i> El seu infant s'apuntarà fins al dia: {{$horas[0]->fecha_fin}} </i> </p>
                        @endif
                        <button type="submit" class="btn btn-primary mt-5 d-flex" style="float: right;">Apuntar</button>
                    </div>
                </form>
                

            </div>
        </div>

    </div>

    @section('script')
        <script src="{{ asset('js/periodico.js') }}" >
        </script>
    @endsection
    @else
        {{redirect()->route('niu.index');}}
    @endif
@endsection
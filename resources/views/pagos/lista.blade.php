@extends('inici')


@section('content')

    @if(isset($facturacio) && count($facturacio) > 0)
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1>Lista : </h1>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Nom Alumne</th>
                                <th scope="col">Cognoms</th>
                                <th scope="col">Dia</th>
                                <th scope="col">Hora Inici</th>
                                <th scope="col">Hora Final</th>
                                <th scope="col">Preu</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($facturacio as $factura)
                            <tr>
                                    <td>{{ $factura->nombre }}</td>
                                    <td>{{ $factura->apellidos }}</td>
                                    <td>{{ $factura->fecha }}</td>
                                    <td>{{ $factura->hora_inicio }}</td>
                                    <td>{{ $factura->hora_fin }}</td>
                                    <td>{{ $factura->Precio }}</td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="5">Total</td>
                                <td>{{ $facturacio->sum('Precio') }}</td>
                            </tr>
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    @endif
@endsection
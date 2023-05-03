@extends('layouts.app')
@section('content')
<br>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header">Fills:</div>
                <div class="card-body">
                    <!--insertar hijo solo para administrador, asignar hijo para el usuario-->
                    @include('adminfunc/insertarHijo')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

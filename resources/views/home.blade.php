@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header">{{ __('Avisos') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    {{ __('Ja estàs enregistrat!') }}
                </div>
            </div>
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
                </div>
            </div>
        </div>
    </div>
</div>

@if($admin)
    @include('adminfunc/gestionadmin')
@endif


@if($monitor)
    @include('monitorfunc/gestionmonitor')
@endif

@endsection

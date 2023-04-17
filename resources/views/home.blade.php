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

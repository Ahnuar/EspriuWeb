@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-12">
            <h2 class="text-center mb-5">Eventos</h2>
        </div>
    </div>
    <div class="row">  
        @if(isset($eventos) && count($eventos)>0)
            @php
                $num = 0;
                $num = 12/count($eventos);
                if($num < 4) $num = 4;
            @endphp
            @foreach ($eventos as $evento)
                <div class="col-12 col-md-6 col-lg-{{$num}}">
                    @include('eventos/block')
                </div>
            @endforeach
        @else
            <div class="col-12">
                <h3 class="text-center">No hay eventos</h3>
            </div>
        @endif
    </div>
</div>
@endsection

@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-12">
            <h2 class="text-center mb-5">Eventos</h2>
        </div>
    </div>
    <div class="row">  
        @if(isset($eventos) && $eventos)
            @php
                $num = 0;
                $num = 12/count($eventos);
                if($num < 3) $num = 3;
            @endphp
            @foreach ($eventos as $evento)
                <div class="col-12 col-md-6 col-lg-{{$num}}">
                    @include('eventos/block')
                </div>
            @endforeach
        @endif
    </div>
</div>
@endsection
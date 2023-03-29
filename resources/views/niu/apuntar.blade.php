@extends('layouts.app')

@section('content')

    @if(@isset($id))
    <div class="container">
        <h1>Apuntar a NIU</h1>

        @if ($errors->any())
            <div class="alert alert-danger text-center">
                @foreach ($errors->all() as $error)
                    {{ $error }}
                @endforeach
            </div>
        @endif
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

            <div class="form-group">
                <label for="hijo">Hijo</label>
                <select name="hijo" id="hijo" class="form-control">
                    @foreach($hijos as $hijo)
                        <option value="{{ $hijo->id }}" @if(old('hijo') == $hijo->id) selected @endif>{{ $hijo->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Apuntar</button>
        </form>

        <div id="calendar">
    </div>
    @else
        {{redirect()->route('niu.index');}}
    @endif
@endsection
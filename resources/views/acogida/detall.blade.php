@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Apuntar a la acogida</h1>

        <form method="POST" action="{{ route('acogida.apuntar') }}">
            @csrf

            <div class="form-group">
                <label for="hora">Hora</label>
                <select name="hora" id="hora" class="form-control">
                    @foreach($horas as $hora)
                        <option value="{{ $hora->id }}" @if(old('hora') == $hora->id) selected @endif>{{ $hora->hora }}</option>
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
    </div>
@endsection

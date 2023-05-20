@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Comproveu la vostra adreça de correu electrònic') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('S\'ha enviat un nou enllaç de verificació a la teva adreça de correu electrònic.') }}                        </div>
                    @endif

                    {{ __('Abans de continuar, comproveu el vostre correu electrònic per obtenir un enllaç de verificació.') }}
                    {{ __('Si no has rebut el correu electrònic') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('clica aquí per sol·licitar un altre') }}                        </button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

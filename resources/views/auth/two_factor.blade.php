@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card border-secondary rounded-0 shadow-sm">
                <div class="card-header bg-black text-white rounded-0">
                    VERIFICACIÓN DE DOS PASOS
                </div>
                <div class="card-body">
                    <p class="text-muted">Hemos enviado un código a tu correo electrónico: <strong>{{ substr(auth()->user()->email, 0, 3) }}***@***</strong></p>

                    @if(session('message'))
                        <div class="alert alert-info">{{ session('message') }}</div>
                    @endif

                    <form method="POST" action="{{ route('verify.store') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="code" class="form-label fw-bold">CÓDIGO DE 6 DÍGITOS</label>
                            <input type="text" name="two_factor_code" class="form-control rounded-0" required autofocus placeholder="123456">
                            @error('two_factor_code')
                                <span class="text-danger small">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-dark rounded-0 text-uppercase">Verificar</button>
                            <a href="{{ route('verify.resend') }}" class="btn btn-link text-secondary">Reenviar código</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
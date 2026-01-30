@extends('layout.guest')

@section('title', 'Login - Finanças em Dia')

@section('content')
<div class="login-card">

    <div class="text-center mb-5">
        <div class="logo-box">
            <img src="{{ asset('images/icon.svg') }}" alt="Icon">
        </div>
        <h1 class="fs-4 fw-black text-white mb-1">Bem-vinda</h1>
        <p class="small mb-0" style="color: var(--text-muted-custom);">
            Gerencie suas finanças de forma eficiente
        </p>
    </div>

    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="mb-4">
            <label class="form-label small fw-bold text-uppercase opacity-75">E-mail</label>
            <div class="position-relative group">
                <i class="bi bi-envelope input-icon"></i>
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="seuemail@exemplo.com" value="{{ old('email') }}" required autofocus>
            </div>
            @error('email')
                <div class="small mt-1" style="color: var(--text-danger-custom);">
                    <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-5">
            <div class="d-flex justify-content-between align-items-center">
                <label class="form-label small fw-bold text-uppercase opacity-75">Senha</label>
            </div>
            <div class="position-relative group">
                <i class="bi bi-lock input-icon"></i>
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="********" required>
            </div>
            @error('password')
                <div class="small mt-1" style="color: var(--text-danger-custom);">
                    <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                </div>
            @enderror
        </div>

        <button type="submit" class="btn btn-login w-100">
            Entrar
        </button>
    </form>

    <div class="mt-4 text-center">
        <p class="small" style="color: var(--text-muted-custom);">
            Não tem uma conta?
            <a href="{{ route('register') }}" class="text-primary fw-bold text-decoration-none ms-1">Registe-se</a>
        </p>
    </div>
</div>
@endsection

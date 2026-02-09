@extends('layout.guest')

@section('title', 'Recuperar Senha - Finanças em Dia')

@section('content')
    <div class="login-card">

        <div class="text-center mb-5">
            <div class="logo-box">
                <img src="{{ asset('images/icon.png') }}" alt="Icon">
            </div>
            <h1 class="fs-4 fw-black text-dark mb-1">Recuperar Senha</h1>
            <p class="small mb-0" style="color: var(--text-muted-custom);">
                Insira o seu e-mail para recuperar a senha
            </p>
        </div>

        <form method="POST" action="#">
            @csrf
            <div class="mb-4">
                <label class="form-label small fw-bold text-uppercase opacity-75">E-mail</label>
                <div class="position-relative group">
                    <i class="bi bi-envelope input-icon"></i>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                        placeholder="seuemail@exemplo.com" value="{{ old('email') }}" required autofocus>
                </div>
                @error('email')
                    <div class="small mt-1" style="color: var(--text-danger-custom);">
                        <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                    </div>
                @enderror
            </div>

            <button type="submit" class="btn btn-login w-100">
                Enviar link de recuperação
            </button>
        </form>

        <div class="mt-4 text-center">
            <p class="small" style="color: var(--text-muted-custom);">
                Lembrou-se da senha?
                <a href="{{ route('login') }}" class="text-primary fw-bold text-decoration-none ms-1">Voltar ao Login</a>
            </p>
        </div>
    </div>
@endsection

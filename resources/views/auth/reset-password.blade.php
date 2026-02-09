@extends('layout.guest')

@section('title', 'Redefinir Senha - Finanças em Dia')

@section('content')
    <div class="login-card">

        <div class="text-center mb-5">
            <div class="logo-box">
                <img src="{{ asset('images/icon.png') }}" alt="Icon">
            </div>
            <h1 class="fs-4 fw-black text-white mb-1">Redefinir Senha</h1>
            <p class="small mb-0" style="color: var(--text-muted-custom);">
                Crie uma nova senha para sua conta
            </p>
        </div>

        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <!-- Password Reset Token -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <div class="mb-4">
                <label class="form-label small fw-bold text-uppercase opacity-75">E-mail</label>
                <div class="position-relative group">
                    <i class="bi bi-envelope input-icon"></i>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                        placeholder="seuemail@exemplo.com" value="{{ old('email', $request->email) }}" required autofocus>
                </div>
                @error('email')
                    <div class="small mt-1" style="color: var(--text-danger-custom);">
                        <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-4">
                <label class="form-label small fw-bold text-uppercase opacity-75">Nova Senha</label>
                <div class="position-relative group">
                    <i class="bi bi-lock input-icon"></i>
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                        placeholder="********" required autocomplete="new-password">
                </div>
                @error('password')
                    <div class="small mt-1" style="color: var(--text-danger-custom);">
                        <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-5">
                <label class="form-label small fw-bold text-uppercase opacity-75">Confirmar Nova Senha</label>
                <div class="position-relative group">
                    <i class="bi bi-lock-fill input-icon"></i>
                    <input type="password" name="password_confirmation" class="form-control" placeholder="********" required
                        autocomplete="new-password">
                </div>
            </div>

            <button type="submit" class="btn btn-login w-100">
                Redefinir Senha
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

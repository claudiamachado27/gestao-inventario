@extends('layout.guest')

@section('title', 'Registo - Finanças em Dia')

@section('content')
<div class="register-card container">
    <div class="text-center mb-4">
        <div class="logo-box">
            <img src="{{ asset('images/icon.png') }}" alt="Icon">
        </div>
        <h1 class="fs-4 fw-black text-white mb-1">Crie sua conta</h1>
        <p class="small mb-0" style="color: var(--text-muted-custom);">E começe a gerenciar suas finanças de forma eficiente</p>
    </div>

    <form id="registerForm" method="POST" action="{{ route('register') }}">
        @csrf



        <div class="mb-3">
            <label class="form-label small fw-bold text-uppercase opacity-75">Nome</label>
            <div class="position-relative group">
                <i class="bi bi-person input-icon"></i>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Seu nome" value="{{ old('name') }}">
            </div>
            @error('name')
                <div class="small mt-1" style="color: var(--text-danger-custom);">
                    <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label small fw-bold text-uppercase opacity-75">E-mail</label>
            <div class="position-relative group">
                <i class="bi bi-envelope input-icon"></i>
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="seuemail@exemplo.com" value="{{ old('email') }}">
            </div>
            @error('email')
                <div class="small mt-1" style="color: var(--text-danger-custom);">
                    <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label small fw-bold text-uppercase opacity-75">Senha</label>
            <div class="position-relative group mb-2">
                <i class="bi bi-lock input-icon"></i>
                <input type="password" name="password" id="password" oninput="validatePassword()" class="form-control @error('password') is-invalid @enderror" placeholder="********">
            </div>
            @error('password')
                <div class="small mt-1" style="color: var(--text-danger-custom);">
                    <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-4">
            <label class="form-label small fw-bold text-uppercase opacity-75">Confirmar Senha</label>
            <div class="position-relative group">
                <i class="bi bi-shield-check input-icon"></i>
                <input type="password" name="password_confirmation" id="confirm_password" oninput="validatePassword()" class="form-control" placeholder="********">
            </div>
            <div id="match-msg" class="small mt-1"></div>
        </div>

        <button type="submit" id="submit-btn" class="btn btn-login w-100">
            Registar
        </button>
    </form>

    <div class="mt-4 text-center">
        <p class="small" style="color: var(--text-muted-custom);">
            Já tem uma conta? <a href="{{ route('login') }}" class="text-primary fw-bold text-decoration-none ms-1">Entrar</a>
        </p>
    </div>
</div>
@endsection

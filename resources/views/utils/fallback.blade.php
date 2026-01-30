@extends('layout.guest')

@section('title', 'Página não encontrada')

@section('content')
    <div class="text-center d-flex flex-column align-items-center justify-content-center" style="min-height: 80vh;">
        <div class="mb-4">
            <img src="{{ asset('images/404error.png') }}" alt="404 Error" class="img-fluid" style="max-height: 300px;">
        </div>

        <h1 class="display-5 fw-bold text-white mb-3">Ups! Página não encontrada!</h1>
        <p class="text-muted-custom mb-4">A página que procura não existe ou foi removida.</p>

        <a href="{{ route('login') }}" class="btn btn-primary-custom d-flex align-items-center justify-content-center gap-2"
            style="max-width: fit-content;">
            <i class="bi bi-house-door-fill"></i>
            Voltar para a Página Inicial
        </a>
    </div>
@endsection

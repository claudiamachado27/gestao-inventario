<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta content="IE=edge" http-equiv="X-UA-Compatible">

    <title>@yield('title', 'Finanças em Dia')</title>
    <meta name="description" content="Sistema de gestão financeira pessoal de Rosa Machado">

    <link href="{{ asset('images/icon.svg') }}" rel="icon" type="image/svg+xml">
    <link rel="shortcut icon" href="{{ asset('images/icon.svg') }}">
    <!--ícone quando salvar o site no ecrã inicial do telemóvel-->
    <link rel="apple-touch-icon" href="{{ asset('images/icon.svg') }}">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <!-- Estilos CSS -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" >

    <!-- Google Fonte: Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700;900&display=swap" rel="stylesheet"/>

    @stack('styles')
</head>

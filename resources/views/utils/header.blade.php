<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta content="IE=edge" http-equiv="X-UA-Compatible">

    <title>@yield('title', 'Gestão do Inventário de Alice Teixeira')</title>
    <meta name="description" content="Sistema de Gestão de receitas e despesas do Inventário de Alice Teixeira">

    <link href="{{ asset('images/icon.png') }}" rel="icon" type="image/png">
    <link rel="shortcut icon" href="{{ asset('images/icon.png') }}">
    <!--ícone quando salvar o site no ecrã inicial do telemóvel-->
    <link rel="apple-touch-icon" href="{{ asset('images/icon.png') }}">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <!-- Estilos CSS -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" >

    <!-- Google Fonte: Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700;900&display=swap" rel="stylesheet"/>

    @stack('styles')
</head>

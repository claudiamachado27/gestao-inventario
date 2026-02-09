<!DOCTYPE html>
<html lang="pt" data-bs-theme="light">


@include('utils.header')

<body class="d-flex flex-column" style="min-height: 100vh;">

    <div class="glow-1"></div>
    <div class="glow-2"></div>

    <main class="container d-flex flex-column align-items-center justify-content-center p-4 flex-grow-1">
        @yield('content')
    </main>

    @include('utils.footer')


    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>

</html>

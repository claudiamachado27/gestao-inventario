<!DOCTYPE html>
<html lang="pt" data-bs-theme="dark">
    @include('utils.header')
<body>
    @include('utils.navbar')

    <main class="container-fluid p-4">
        @yield('content')
    </main>

    @include('utils.footer')

    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>

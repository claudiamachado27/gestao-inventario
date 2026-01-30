<nav class="navbar sticky-top px-3 py-2 bg-surface border-bottom border-custom shadow-sm">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-nowrap">

        <a href="{{ route('dashboard') }}" class="navbar-brand d-flex align-items-center me-2">
            <img src="{{ asset('images/logo.png') }}" alt="Logo Finanças em Dia" height="35">
        </a>

        <div class="d-flex align-items-center gap-2 gap-sm-3">
            <span class="small fw-bold mb-0 text-nowrap">
                Olá, <span class="text-white">{{ Auth::user()->name }}</span>
            </span>

            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-sm btn-outline-secondary border-custom btn-logout-custom text-white d-flex align-items-center gap-2 px-2 px-sm-3 shadow-none">
                    <span class="d-none d-md-inline">Sair</span>
                    <i class="bi bi-box-arrow-right"></i>
                </button>
            </form>
        </div>

    </div>
</nav>

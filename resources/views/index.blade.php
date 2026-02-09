@extends('layout.main_layout')

@section('title', 'Finanças em Dia')

@section('content')
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" role="alert"
            style="background-color: rgba(59, 130, 246, 0.1); color: var(--bs-primary);">
            <i class="bi bi-check-circle-fill me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-end mb-4 gap-3">
        <div>
            <h2 class="display-6 fw-black mb-1">Todas as Movimentações</h2>
            <p class="text-muted-custom small mb-0">Gestão de receitas e despesas do Inventário de Alice Teixeira.</p>
        </div>
        <div class="d-flex gap-2">
            @if (Auth::user()->role === 'admin')
                <button type="button" class="btn btn-action rounded-3 d-flex align-items-center" data-bs-toggle="modal"
                    data-bs-target="#createMovementModal">
                    <i class="bi bi-plus-lg me-2"></i>Inserir
                </button>

                <button type="button" class="btn btn-action rounded-3 d-flex align-items-center" data-bs-toggle="modal"
                    data-bs-target="#editMovementModal">
                    <i class="bi bi-pencil me-2"></i>Editar
                </button>

                <button type="button" class="btn btn-action rounded-3 d-flex align-items-center" data-bs-toggle="modal"
                    data-bs-target="#deleteMovementModal">
                    <i class="bi bi-trash me-2"></i>Apagar
                </button>
            @endif

            <button onclick="window.print()" class="btn btn-action rounded-3 d-flex align-items-center">
                <i class="bi bi-printer me-2"></i>Imprimir
            </button>
        </div>
    </div>

    <form action="{{ route('dashboard') }}" method="GET" id="filter-form" class="row g-3 mb-4 align-items-end">
        <input type="hidden" name="tipo" id="tipo-filter" value="{{ request('tipo') }}">
        <div class="col-auto">
            <label class="small fw-bold mb-2 d-block text-muted-custom">Mês</label>
            <select name="month" class="form-select bg-surface border-custom text-white"
                style="width: 160px; font-size: 0.9rem;" onchange="this.form.submit()">
                <option value="">Todos</option>
                @php
                    $meses = [
                        1 => 'Janeiro',
                        2 => 'Fevereiro',
                        3 => 'Março',
                        4 => 'Abril',
                        5 => 'Maio',
                        6 => 'Junho',
                        7 => 'Julho',
                        8 => 'Agosto',
                        9 => 'Setembro',
                        10 => 'Outubro',
                        11 => 'Novembro',
                        12 => 'Dezembro',
                    ];
                @endphp
                @foreach ($meses as $num => $nome)
                    <option value="{{ $num }}" @selected(request('month') == $num)>{{ $nome }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-auto">
            <label class="small fw-bold mb-2 d-block text-muted-custom">Ano</label>
            <select name="year" class="form-select bg-surface border-custom text-white"
                style="width: 110px; font-size: 0.9rem;" onchange="this.form.submit()">
                <option value="">Todos</option>
                @for ($y = 2026; $y <= $endYear; $y++)
                    <option value="{{ $y }}" @selected(request('year') == $y)>{{ $y }}</option>
                @endfor
            </select>
        </div>
        <div class="col d-flex justify-content-end gap-2 mb-1">
            <button type="button" onclick="applyTypeFilter('')"
                class="btn rounded-pill px-4 btn-sm {{ !request('tipo') ? 'btn-light fw-bold active' : 'btn-green-solid' }}">Todas</button>
            <button type="button" onclick="applyTypeFilter('receita')"
                class="btn rounded-pill px-4 btn-sm {{ request('tipo') == 'receita' ? 'btn-light fw-bold active' : 'btn-green-solid' }}">Receitas</button>
            <button type="button" onclick="applyTypeFilter('despesa')"
                class="btn rounded-pill px-4 btn-sm {{ request('tipo') == 'despesa' ? 'btn-light fw-bold active' : 'btn-green-solid' }}">Despesas</button>
        </div>
    </form>

    <div class="row g-3 mb-5">
        @if (request()->filled('month') || request()->filled('year'))
            <div class="col-md-3">
                <div class="stat-card">
                    <i class="bi bi-calendar-check stat-icon text-info"></i>
                    <p class="small text-uppercase fw-bold text-muted-custom mb-1">Saldo Anterior</p>
                    <h3 class="fw-bold mb-0">R$ {{ number_format($saldoAnterior, 2, ',', '.') }}</h3>
                </div>
            </div>
        @endif

        <div class="{{ request()->filled('month') || request()->filled('year') ? 'col-md-3' : 'col-md-4' }}">
            <div class="stat-card">
                <i class="bi bi-graph-up stat-icon text-success-custom"></i>
                <p class="small text-uppercase fw-bold text-muted-custom mb-1">Total Receitas</p>
                <h3 class="fw-bold mb-0 text-success-custom">R$ {{ number_format($totalReceitas, 2, ',', '.') }}</h3>
            </div>
        </div>
        <div class="{{ request()->filled('month') || request()->filled('year') ? 'col-md-3' : 'col-md-4' }}">
            <div class="stat-card">
                <i class="bi bi-graph-down stat-icon text-danger-custom"></i>
                <p class="small text-uppercase fw-bold text-muted-custom mb-1">Total Despesas</p>
                <h3 class="fw-bold mb-0 text-danger-custom">R$ {{ number_format($totalDespesas, 2, ',', '.') }}</h3>
            </div>
        </div>
        <div class="{{ request()->filled('month') || request()->filled('year') ? 'col-md-3' : 'col-md-4' }}">
            <div class="stat-card" style="background-color: rgba(59, 130, 246, 0.05);">
                <i class="bi bi-wallet2 stat-icon text-white"></i>
                <p class="small text-uppercase fw-bold text-primary-custom mb-1">Saldo Atual</p>
                <h3 class="fw-bold mb-0">R$ {{ number_format($saldo, 2, ',', '.') }}</h3>
            </div>
        </div>
    </div>

    <div class="bg-surface border-custom rounded-3 overflow-hidden shadow">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th style="width: 110px;" class="ps-4">Data</th>
                        <th style="width: auto;">Descrição</th>
                        <th style="width: 160px;">Categoria</th>
                        <th style="width: 130px;">Tipo</th>
                        <th style="width: 160px;" class="text-end pe-4">Valor</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($movements as $movement)
                        <tr class="movement-row" data-tipo="{{ $movement->tipo }}">
                            <td class="ps-4">{{ $movement->data->format('d/m/y') }}</td>
                            <td class="fw-bold text-nowrap">{{ $movement->descricao }}</td>
                            <td><span class="badge-cat"><i
                                        class="bi {{ $movement->category ? $movement->category->icon : 'bi-question' }} {{ $movement->category ? $movement->category->color : '' }}"></i>
                                    {{ $movement->category ? $movement->category->nome : 'N/A' }}</span></td>
                            <td><span
                                    class="type-pill {{ $movement->tipo == 'receita' ? 'text-success-custom' : 'text-danger' }}"><i
                                        class="bi bi-circle-fill" style="font-size: 0.4rem;"></i>
                                    {{ ucfirst($movement->tipo) }}</span></td>
                            <td
                                class="text-end pe-4 fw-bold {{ $movement->tipo == 'receita' ? 'text-success-custom' : 'text-danger' }} text-nowrap">
                                {{ $movement->tipo == 'receita' ? '+' : '-' }}
                                R$ {{ number_format($movement->valor, 2, ',', '.') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-4">Não existem movimentações neste
                                período.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Paginação --}}
        <div
            class="d-flex flex-column flex-sm-row justify-content-between align-items-center gap-3 p-4 bg-opacity-20 border-top border-custom">
            <p class="small mb-0">Mostrando <b
                    class="text-primary-custom">{{ $movements->firstItem() }}-{{ $movements->lastItem() }}</b> de <b
                    class="text-primary-custom">{{ $movements->total() }}</b> resultados</p>
            <nav>
                <ul class="pagination pagination-sm mb-0 gap-1">
                    {{-- Botão Anterior --}}
                    @if ($movements->onFirstPage())
                        <li class="page-item disabled"><span class="page-link"><i class="bi bi-chevron-left"></i></span>
                        </li>
                    @else
                        <li class="page-item"><a class="page-link" href="{{ $movements->previousPageUrl() }}"><i
                                    class="bi bi-chevron-left"></i></a></li>
                    @endif

                    {{-- Números das Páginas --}}
                    @foreach ($movements->getUrlRange(max(1, $movements->currentPage() - 2), min($movements->lastPage(), $movements->currentPage() + 2)) as $page => $url)
                        <li class="page-item {{ $page == $movements->currentPage() ? 'active' : '' }}">
                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                        </li>
                    @endforeach

                    {{-- Botão Próximo --}}
                    @if ($movements->hasMorePages())
                        <li class="page-item"><a class="page-link" href="{{ $movements->nextPageUrl() }}"><i
                                    class="bi bi-chevron-right"></i></a></li>
                    @else
                        <li class="page-item disabled"><span class="page-link"><i class="bi bi-chevron-right"></i></span>
                        </li>
                    @endif
                </ul>
            </nav>
        </div>
    </div>

    <!-- Modal Adicionar Movimento -->
    @include('movements.create')
    @include('movements.edit')
    @include('movements.delete')

    @push('scripts')
        <script>
            function applyTypeFilter(tipo) {
                document.getElementById('tipo-filter').value = tipo;
                document.getElementById('filter-form').submit();
            }

            document.addEventListener('DOMContentLoaded', function() {
                // Auto-hide success alert after 3 seconds
                const alert = document.querySelector('.alert-success');
                if (alert) {
                    setTimeout(() => {
                        const bsAlert = new bootstrap.Alert(alert);
                        bsAlert.close();
                    }, 3000);
                }
            });
        </script>
    @endpush
@endsection

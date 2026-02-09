<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Movement;
use App\Models\Category;

class DashboardController extends Controller
{
    /**
     * Exibe a página principal (Dashboard)
     */
    public function index(Request $request)
    {


        $query = Movement::with('category')->orderBy('data', 'desc');

        // Filtrar por Mês
        if ($request->filled('month')) {
            $query->whereMonth('data', $request->month);
        }

        // Filtrar por Ano
        if ($request->filled('year')) {
            $query->whereYear('data', $request->year);
        }

        // Calcular totais ANTES da paginação e ANTES do filtro de tipo para refletir o conjunto filtrado completo por mês/ano
        $totalReceitas = (clone $query)->where('tipo', 'receita')->sum('valor');
        $totalDespesas = (clone $query)->where('tipo', 'despesa')->sum('valor');
        $saldo = $totalReceitas - $totalDespesas;

        // Filtrar por Tipo (receita ou despesa) na listagem
        if ($request->filled('tipo') && in_array($request->tipo, ['receita', 'despesa'])) {
            $query->where('tipo', $request->tipo);
        }

        $movements = $query->paginate(10)->withQueryString();
        $allMovements = Movement::orderBy('data', 'desc')->get();
        $categories = Category::orderBy('nome')->get();

        // Calcular Saldo do Mês Anterior (se houver filtros de data)
        $saldoAnterior = 0;
        if ($request->filled('month') || $request->filled('year')) {
            $y = $request->filled('year') ? $request->year : date('Y');
            $m = $request->filled('month') ? $request->month : 1;
            $dataInicioMes = sprintf('%04d-%02d-01', $y, $m);

            // Se for Janeiro de 2026 (ou antes), o saldo anterior é explicitamente 0
            if ($y < 2026 || ($y == 2026 && $m == 1)) {
                $saldoAnterior = 0;
            } else {
                $receitasAnteriores = Movement::where('data', '<', $dataInicioMes)
                    ->where('tipo', 'receita')
                    ->sum('valor');

                $despesasAnteriores = Movement::where('data', '<', $dataInicioMes)
                    ->where('tipo', 'despesa')
                    ->sum('valor');

                $saldoAnterior = $receitasAnteriores - $despesasAnteriores;
            }

            // Ajustar o Saldo Atual para incluir o saldo anterior
            $saldo = $saldoAnterior + ($totalReceitas - $totalDespesas);
        }

        // Movimento selecionado para edição (via query string)
        $selectedMovement = null;
        if ($request->filled('id')) {
            $selectedMovement = Movement::find($request->id);
        }

        // Calcular ano final dinâmico para o filtro
        $startYear = 2026;
        $currentYear = (int) date('Y');
        $currentMonth = (int) date('n');

        // Pega o maior ano e o maior mês desse ano que existem nas movimentações
        $latestMovement = Movement::orderBy('data', 'desc')->first();
        $maxYearData = $latestMovement ? (int) date('Y', strtotime($latestMovement->data)) : $startYear;
        $maxMonthData = $latestMovement ? (int) date('n', strtotime($latestMovement->data)) : 1;

        $baseYear = max($currentYear, $maxYearData);
        $baseMonth = ($baseYear == $currentYear) ? max($currentMonth, $maxMonthData) : $maxMonthData;

        $endYear = ($baseMonth == 12) ? $baseYear + 1 : $baseYear;
        $endYear = max($endYear, $startYear);

        return view('index', compact('movements', 'allMovements', 'categories', 'totalReceitas', 'totalDespesas', 'saldo', 'selectedMovement', 'saldoAnterior', 'endYear'));
    }


}

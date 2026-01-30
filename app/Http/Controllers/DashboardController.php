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
        // Se não houver mês nem ano na request, assume o atual
        if (!$request->has('month') && !$request->has('year')) {
            $request->merge([
                'month' => date('n'),
                'year' => date('Y')
            ]);
        }

        $query = Movement::with('category')->orderBy('data', 'desc');

        // Filtrar por Mês
        if ($request->filled('month')) {
            $query->whereMonth('data', $request->month);
        }

        // Filtrar por Ano
        if ($request->filled('year')) {
            $query->whereYear('data', $request->year);
        }

        // Calcular totais ANTES da paginação para refletir o conjunto filtrado completo
        $totalReceitas = (clone $query)->where('tipo', 'receita')->sum('valor');
        $totalDespesas = (clone $query)->where('tipo', 'despesa')->sum('valor');
        $saldo = $totalReceitas - $totalDespesas;

        $movements = $query->paginate(5);
        $categories = Category::all();

        // Movimento selecionado para edição (via query string)
        $selectedMovement = null;
        if ($request->filled('id')) {
            $selectedMovement = Movement::find($request->id);
        }

        return view('index', compact('movements', 'categories', 'totalReceitas', 'totalDespesas', 'saldo', 'selectedMovement'));
    }


}
